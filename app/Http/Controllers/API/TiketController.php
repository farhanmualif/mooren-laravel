<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tiket;
use App\Models\InfoTiket;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Models\TicketPhoto;

class TiketController extends Controller
{
    public function index()
    {
        try {
            // Ambil data user yang sedang login
            $user = Auth::user();

            // Ambil semua data Info Tiket dari database
            $tiket = InfoTiket::with('gunung')->get();

            // Cek apakah data ditemukan
            if ($tiket->isEmpty()) {
                return response()->json([
                    'response_code' => '404',
                    'status' => 'error',
                    'message' => 'No data found',
                    'data' => [],
                ], 404);
            }

            // Kembalikan respons dengan data
            return response()->json([
                'response_code' => '200',
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => $tiket,
            ], 200);
        } catch (Exception $e) {
            // Tangani error jika terjadi exception
            return response()->json([
                'response_code' => '500',
                'status' => 'error',
                'message' => 'Failed to retrieve data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'id_gunung' => 'required|exists:gunungs,id',
                'pos_perizinan_masuk' => 'required|string',
                'pos_perizinan_keluar' => 'required|string',
                'tgl_masuk' => 'required|date',
                'tgl_keluar' => 'required|date|after_or_equal:tgl_masuk',
                'total_harga' => 'required|numeric',
                'metode_pembayaran' => 'required|in:bank_transfer,cash_on_delivery',
            ]);

            // Ambil data user yang sedang login
            $user = Auth::user();

            // Simpan data tiket ke database
            $tiket = new Tiket();
            $tiket->id_user = $user->id;
            $tiket->id_gunung = $request->id_gunung;
            $tiket->pos_perizinan_masuk = $request->pos_perizinan_masuk;
            $tiket->pos_perizinan_keluar = $request->pos_perizinan_keluar;
            $tiket->tgl_masuk = $request->tgl_masuk;
            $tiket->tgl_keluar = $request->tgl_keluar;
            $tiket->metode_pembayaran = $request->metode_pembayaran;
            $tiket->total_harga = $request->total_harga;
            $tiket->status_pembayaran = 'pending';
            $tiket->save();

            // Kembalikan respons sukses
            return response()->json([
                'response_code' => '200',
                'status' => 'success',
                'message' => 'Tiket berhasil ditambahkan',
                'data' => $tiket,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'response_code' => '500',
                'status' => 'error',
                'message' => 'Gagal menambahkan tiket',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($kodeTiket)
    {
        try {
            // Cari tiket berdasarkan kode tiket
            $tiket = Tiket::where('kode_tiket', $kodeTiket)
                ->with('gunung')
                ->first();

            // Cek apakah tiket ditemukan
            if (!$tiket) {
                return response()->json([
                    'response_code' => '404',
                    'status' => 'error',
                    'message' => 'Tiket tidak ditemukan',
                    'data' => [],
                ], 404);
            }

            // Kembalikan respons dengan data tiket
            return response()->json([
                'response_code' => '200',
                'status' => 'success',
                'message' => 'Tiket ditemukan',
                'data' => $tiket,
            ], 200);
        } catch (Exception $e) {
            // Tangani error jika terjadi exception
            return response()->json([
                'response_code' => '500',
                'status' => 'error',
                'message' => 'Gagal menampilkan data tiket',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function tiket_saya()
    {
        try {
            // Ambil data user yang sedang login
            $user = Auth::user();

            // Ambil semua tiket berdasarkan user yang sedang login, diurutkan dari yang terbaru
            $tiket = Tiket::with(['gunung', 'user'])
                ->where('id_user', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();

            // Cek apakah data ditemukan
            if ($tiket->isEmpty()) {
                return response()->json([
                    'response_code' => '404',
                    'status' => 'error',
                    'message' => 'No tickets found for this user',
                    'data' => [],
                ], 404);
            }

            // Kembalikan respons dengan data tiket
            return response()->json([
                'response_code' => '200',
                'status' => 'success',
                'message' => 'Tickets retrieved successfully',
                'data' => $tiket,
            ], 200);
        } catch (Exception $e) {
            // Tangani error jika terjadi exception
            return response()->json([
                'response_code' => '500',
                'status' => 'error',
                'message' => 'Failed to retrieve tickets',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function ubah_tiket(Request $request)
    {
        try {
            // Validasi request
            $validator = Validator::make($request->all(), [
                'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'response_code' => '400',
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 400);
            }

            // Upload gambar baru
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $filename = time() . '.' . $photo->getClientOriginalExtension();
                $photo->move(public_path('ticket_photos'), $filename);
                // Simpan path foto ke database
                $ticketPhoto = new TicketPhoto();
                $ticketPhoto->photo_path = 'ticket_photos/' . $filename;
                $ticketPhoto->save();

                return response()->json([
                    'response_code' => '200',
                    'status' => 'success',
                    'message' => 'Foto tiket berhasil diubah',
                    'data' => [
                        'photo_path' => $ticketPhoto->photo_path
                    ]
                ], 200);
            }

            return response()->json([
                'response_code' => '400',
                'status' => 'error',
                'message' => 'Tidak ada file yang diupload'
            ], 400);
        } catch (Exception $e) {
            //
        }
    }
}
