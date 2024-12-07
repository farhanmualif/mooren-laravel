<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Auth;
use Hash;

class AuthenticationController extends Controller
{
    public function register(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name'     => 'required|min:4',
            'email'    => 'required|email|unique:users,email', // Ensure the email is unique
            'password' => 'required|min:8',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            // Return custom error message if email is already registered
            $errors = $validator->errors();
            if ($errors->has('email')) {
                return response()->json([
                    'response_code' => '400',
                    'status' => 'error',
                    'message' => 'Email sudah terdaftar.',
                ]);
            }

            // Return other validation errors
            return response()->json([
                'response_code' => '400',
                'status' => 'error',
                'message' => $errors->first(),
            ], 400);
        }

        // If validation passes, create the user
        $dt        = Carbon::now();
        $join_date = $dt->toDayDateTimeString();

        $user = new User();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        // Prepare the response data
        $data = [];
        $data['response_code'] = '200';
        $data['status']        = 'success';
        $data['message']       = 'Registration successful';

        return response()->json($data, 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]);

        try {
            $email = $request->email;
            $password = $request->password;

            // Cari user berdasarkan email
            $user = User::where('email', $email)->first();

            // Cek apakah user ditemukan dan password sesuai
            if ($user && Hash::check($password, $user->password)) {
                // Hasilkan token akses
                $accessToken = $user->createToken($user->email)->accessToken;

                // Format respon sukses
                $data = [
                    'response_code' => '200',
                    'status'        => 'success',
                    'message'       => 'Login successful',
                    'data' => [
                        'user'  => $user,
                        'token' => $accessToken,
                    ]
                ];

                return response()->json($data, 200);
            } else {
                // Format respon gagal jika email atau password salah
                $data = [
                    'response_code' => '401',
                    'status'        => 'error',
                    'message'       => 'Unauthorized'
                ];

                return response()->json($data, 401);
            }
        } catch (\Exception $e) {
            \Log::error('Login Error: ' . $e->getMessage());

            $data = [
                'response_code' => '500',
                'status'        => 'error',
                'message'       => 'Login failed due to server error'
            ];

            return response()->json($data, 500);
        }
    }

    public function profile(Request $request)
    {
        try {
            // Get the authenticated user
            $user = Auth::user();

            if ($user) {
                // Prepare the response data
                $data = [];
                $data['response_code'] = '200';
                $data['status']        = 'success';
                $data['message']       = 'Profile data retrieved successfully';
                $data['data'] = [
                    'user' => $user,
                ];

                return response()->json($data, 200);
            } else {
                // Return an error response if user is not authenticated
                $data = [];
                $data['response_code'] = '401';
                $data['status']        = 'error';
                $data['message']       = 'Unauthenticated';

                return response()->json($data, 401);
            }
        } catch (\Exception $e) {
            // Log the error and return an error response
            \Log::error('Error retrieving profile: ' . $e->getMessage());

            $data = [];
            $data['response_code'] = '500';
            $data['status']        = 'error';
            $data['message']       = 'Failed to retrieve profile';

            return response()->json($data, 500);
        }
    }

    public function update(Request $request)
    {
        try {
            // Get the authenticated user
            $user = Auth::user();

            // If there's no authenticated user, return a token error response
            if (!$user) {
                return response()->json([
                    'response_code' => '401',
                    'status' => 'error',
                    'message' => 'Unauthorized: Invalid or missing token'
                ], 401);
            }

            // Update user data
            $user->name = $request->name;
            $user->email = $request->email;
            $user->no_telp = $request->no_telp;
            $user->alamat = $request->alamat;
            $user->hobi = $request->hobi;

            // Update password only if provided
            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }

            // Save changes to the database
            $user->save();

            // Prepare success response
            $message = 'Profile updated successfully';
            return response()->json([
                'response_code' => '200',
                'status' => 'success',
                'message' => $message,
                'data' => $user,
            ]);
        } catch (\Exception $e) {
            // Handle exceptions and return error response
            return response()->json([
                'response_code' => '500',
                'status' => 'error',
                'message' => 'An error occurred while updating the profile: ' . $e->getMessage()
            ], 500);
        }
    }
}
