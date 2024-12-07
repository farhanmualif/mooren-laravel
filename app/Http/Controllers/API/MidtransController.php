<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Tiket;
use App\Models\Midtrans;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MidtransController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createTransaction(Request $request)
    {
        try {
            // Get tiket first to avoid undefined variable
            $tiket = Tiket::where('kode_tiket', $request->kode_tiket)->firstOrFail();

            // Check existing pending transaction
            $existingTransaction = Midtrans::where([
                'order_id' => $request->order_id,
                'status' => 'pending'
            ])->first();

            if ($existingTransaction) {
                // Generate new snap token for existing transaction
                $tiket = Tiket::where('kode_tiket', $request->kode_tiket)->firstOrFail();

                $params = [
                    'transaction_details' => [
                        'order_id' => $existingTransaction->order_id,
                        'gross_amount' => (int)$tiket->total_harga,
                    ],
                    'customer_details' => [
                        'first_name' => $request->nama,
                        'email' => $request->email ?? $request->user()->email
                    ],
                    'callbacks' => [
                        'finish' => 'tiketmobile://payment?status=success',
                        'error' => 'tiketmobile://payment?status=failed',
                        'pending' => 'tiketmobile://payment?status=pending'
                    ],
                    'enable_payments' => ['gopay', 'shopeepay', 'bca_va', 'bni_va', 'bri_va'],
                    'gopay' => [
                        'enable_callback' => true,
                        'callback_url' => 'tiketmobile://payment'
                    ],
                    'shopeepay' => [
                        'callback_url' => 'tiketmobile://payment'
                    ]
                ];

                $snapToken = Snap::getSnapToken($params);

                // Update the existing transaction with new snap token
                $existingTransaction->update([
                    'snap_token' => $snapToken
                ]);

                return response()->json([
                    'status' => 'Success',
                    'message' => 'Menggunakan transaksi yang sudah ada',
                    'data' => [
                        'order_id' => $existingTransaction->order_id,
                        'snap_token' => $snapToken
                    ]
                ], 200);
            }

            $orderId = 'ORDER-' . time();

            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int)$tiket->total_harga,
                ],
                'customer_details' => [
                    'first_name' => $request->nama,
                    'email' => $request->email ?? $request->user()->email
                ],
                'callbacks' => [
                    'finish' => 'tiketmobile://payment?status=success',
                    'error' => 'tiketmobile://payment?status=failed',
                    'pending' => 'tiketmobile://payment?status=pending'
                ],
                'enable_payments' => ['gopay', 'shopeepay', 'bca_va', 'bni_va', 'bri_va'],
                'gopay' => [
                    'enable_callback' => true,
                    'callback_url' => 'tiketmobile://payment'
                ],
                'shopeepay' => [
                    'callback_url' => 'tiketmobile://payment'
                ]
            ];

            $snapToken = Snap::getSnapToken($params);

            // Create initial Midtrans record
            Midtrans::create([
                'order_id' => $orderId,
                'kode_tiket' => $tiket->kode_tiket,
                'id_user' => $tiket->id_user,
                'total_harga' => $tiket->total_harga,
                'status' => 'pending',
                'payment_url' => 'https://app.sandbox.midtrans.com/snap/v3/redirection/' . $snapToken,
                'snap_token' => $snapToken
            ]);

            // Fix syntax errors in tiket update
            if ($tiket) {
                $tiket->update([
                    'order_id' => $orderId,
                    'status_pembayaran' => 'pending'
                ]);
            }

            return response()->json([
                'response_code' => '201',
                'status' => 'success',
                'message' => 'Transaction token created successfully',
                'snap_token' => $snapToken,
                'redirect_url' => 'https://app.sandbox.midtrans.com/snap/v3/redirection/' . $snapToken
            ], 201);

        } catch (Exception $e) {
            Log::error('Midtrans Create Transaction Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'Error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function handleNotification(Request $request)
    {
        try {
            $notification = $request->all();
            Log::info('Received Midtrans notification:', $notification);

            $status = null;
            $order_id = $notification['order_id'];
            $transaction_status = $notification['transaction_status'];
            $fraud_status = $notification['fraud_status'] ?? null;

            // Find transaction by Midtrans order_id
            $transaction = Midtrans::where('order_id', $order_id)->first();
            if (!$transaction) {
                Log::error('Transaction not found for order_id: ' . $order_id);
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Transaction not found'
                ], 404);
            }

            // Get tiket using kode_tiket from transaction
            $tiket = Tiket::where('kode_tiket', $transaction->kode_tiket)->first();
            if (!$tiket) {
                Log::error('Ticket not found for kode_tiket: ' . $transaction->kode_tiket);
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Ticket not found'
                ], 404);
            }

            if ($transaction_status == 'capture') {
                $status = ($fraud_status == 'accept') ? 'success' : 'pending';
            } else if ($transaction_status == 'settlement') {
                $status = 'success';
            } else if ($transaction_status == 'pending') {
                $status = 'pending';
            } else if (in_array($transaction_status, ['deny', 'cancel', 'expire'])) {
                $status = 'failed';
            }

            Log::info('Processing status update:', [
                'order_id' => $order_id,
                'old_status' => $transaction->status,
                'new_status' => $status,
                'transaction_status' => $transaction_status
            ]);

            // Update transaction status
            DB::transaction(function () use ($transaction, $tiket, $status, $notification) {
                $transaction->update([
                    'status' => $status,
                    'payment_type' => $notification['payment_type'] ?? null,
                    'payment_data' => json_encode($notification)
                ]);

                $tiket->update([
                    'status_pembayaran' => $status
                ]);

                Log::info('Successfully updated status for:', [
                    'order_id' => $transaction->order_id,
                    'status' => $status
                ]);
            });

            return response()->json([
                'status' => 'Success',
                'message' => 'Notification handled successfully'
            ]);

        } catch (Exception $e) {
            Log::error('Error handling Midtrans notification:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'Error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function checkStatus($orderId)
    {
        try {
            $transaction = Midtrans::where('order_id', $orderId)->first();
            if (!$transaction) {
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Transaction not found'
                ], 404);
            }

            return response()->json([
                'status' => 'Success',
                'data' => [
                    'status' => $transaction->status,
                    'payment_type' => $transaction->payment_type,
                    'order_id' => $transaction->order_id
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'Error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
