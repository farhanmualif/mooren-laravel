<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Panduan;
use App\Models\Gunung;
use App\Models\TicketPhoto;
use Illuminate\Http\Response;

class MenuController extends Controller
{
    public function index()
    {
        try {
            // Ambil data user yang sedang login

            // Ambil semua data Panduan dari database
            $menu = Panduan::all();

            // Cek apakah data ditemukan
            if ($menu->isEmpty()) {
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
                'data' => $menu,
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

    public function menuById($id = null)
    {
        try {
            // Jika parameter ID disertakan, ambil data panduan berdasarkan ID
            if ($id) {
                $menu = Panduan::find($id);

                // Cek apakah data ditemukan
                if (!$menu) {
                    return response()->json([
                        'response_code' => '404',
                        'status' => 'error',
                        'message' => 'Data not found',
                        'data' => [],
                    ], 404);
                }

                // Kembalikan data panduan berdasarkan ID
                return response()->json([
                    'response_code' => '200',
                    'status' => 'success',
                    'message' => 'Data retrieved successfully',
                    'data' => $menu,
                ], 200);
            }

            // Jika ID tidak disertakan, ambil semua data panduan
            $menu = Panduan::all();

            // Cek apakah data ditemukan
            if ($menu->isEmpty()) {
                return response()->json([
                    'response_code' => '404',
                    'status' => 'error',
                    'message' => 'No data found',
                    'data' => [],
                ], 404);
            }

            // Kembalikan semua data panduan
            return response()->json([
                'response_code' => '200',
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => $menu,
            ], 200);
        } catch (Exception $e) {
            // Tangani error jika terjadi exception
            return response()->json([
                'response_code' => '500',
                'status' => 'error',
                'message' => 'Failed to retrieve data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function gunung()
    {
        try {
            // Ambil data user yang sedang login

            // Ambil semua data Panduan dari database
            $menu = Gunung::all();

            // Cek apakah data ditemukan
            if ($menu->isEmpty()) {
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
                'data' => $menu,
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

    public function gunungById($id = null)
    {
        try {
            // Jika parameter ID disertakan, ambil data gunung berdasarkan ID
            if ($id) {
                $menu = Gunung::find($id);

                // Cek apakah data ditemukan
                if (!$menu) {
                    return response()->json([
                        'response_code' => '404',
                        'status' => 'error',
                        'message' => 'Data not found',
                        'data' => [],
                    ], 404);
                }

                // Kembalikan data gunung berdasarkan ID
                return response()->json([
                    'response_code' => '200',
                    'status' => 'success',
                    'message' => 'Data retrieved successfully',
                    'data' => $menu,
                ], 200);
            }

            // Jika ID tidak disertakan, ambil semua data gunung
            $menu = Gunung::all();

            // Cek apakah data ditemukan
            if ($menu->isEmpty()) {
                return response()->json([
                    'response_code' => '404',
                    'status' => 'error',
                    'message' => 'No data found',
                    'data' => [],
                ], 404);
            }

            // Kembalikan data semua gunung
            return response()->json([
                'response_code' => '200',
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => $menu,
            ], 200);
        } catch (Exception $e) {
            // Tangani error jika terjadi exception
            return response()->json([
                'response_code' => '500',
                'status' => 'error',
                'message' => 'Failed to retrieve data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function gambarTiket()
    {
        try {
            $gambarTiket = TicketPhoto::first();

            if (!$gambarTiket) {
                return response()->json([
                    'status' => false,
                    'message' => 'Gambar tiket tidak ditemukan',
                    'data' => null
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'status' => true,
                'message' => 'Berhasil mengambil gambar tiket',
                'data' => [
                    'photo_path' => $gambarTiket->photo_path
                ]
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'data' => null
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
