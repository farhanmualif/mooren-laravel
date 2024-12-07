<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gunung;
use App\Models\Panduan;
use App\Models\User;
use App\Models\InfoTiket;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function dashboard()
    {
        return view('home.home');
    }

    public function gunung()
    {
        return view('gunung.index');
    }

    public function tambah_gunung()
    {
        return view('gunung.tambah');
    }

    public function edit_gunung($id)
    {
        // Fetch the gunung data from the database
        $gunung = Gunung::findOrFail($id); // Assuming you want to find the gunung by ID

        // Pass the gunung data to the view as an associative array
        return view('gunung.edit', ['gunung' => $gunung]);
    }

    public function hapus_gunung($id)
    {
        // Cari data gunung berdasarkan ID
        $gunung = Gunung::findOrFail($id);

        // Hapus data gunung
        $gunung->delete();

        // Redirect kembali ke halaman daftar gunung dengan pesan sukses
        return redirect()->route('gunung')->with('message', 'Data Gunung berhasil dihapus!');
    }

    public function panduan()
    {
        return view('panduan.index');
    }

    public function tambah_panduan()
    {
        return view('panduan.tambah');
    }

    public function edit_panduan($id)
    {
        // Fetch the panduan data from the database
        $panduan = Panduan::findOrFail($id); // Assuming you want to find the panduan by ID

        // Pass the panduan data to the view as an associative array
        return view('panduan.edit', ['panduan' => $panduan]);
    }

    public function hapus_panduan($id)
    {
        // Cari data panduan berdasarkan ID
        $panduan = Panduan::findOrFail($id);

        // Hapus data panduan
        $panduan->delete();

        // Redirect kembali ke halaman daftar panduan dengan pesan sukses
        return redirect()->route('panduan')->with('message', 'Data Panduan berhasil dihapus!');
    }

    public function info_tiket()
    {
        return view('info-tiket.index');
    }

    public function tambah_info_tiket()
    {
        return view('info-tiket.tambah');
    }

    public function edit_info_tiket($id)
    {
        // Fetch the info tiket data from the database
        $info_tiket = InfoTiket::findOrFail($id); // Assuming you want to find the info tiket by ID

        // Pass the info tiket data to the view as an associative array
        return view('info-tiket.edit', ['info_tiket' => $info_tiket]);
    }

    public function hapus_info_tiket($id)
    {
        // Cari data info tiket berdasarkan ID
        $info_tiket = InfoTiket::findOrFail($id);

        // Hapus data info tiket
        $info_tiket->delete();

        // Redirect kembali ke halaman daftar info tiket dengan pesan sukses
        return redirect()->route('info-tiket')->with('message', 'Data Info Tiket berhasil dihapus!');
    }

    public function pesanan()
    {
        return view('pesanan.index');
    }

    public function pembayaran()
    {
        return view('pembayaran.index');
    }

    public function tambah_pembayaran()
    {
        return view('pembayaran.tambah');
    }

    public function user()
    {
        return view('user.index');
    }
    public function edit_gambar_tiket()
    {
        return view('gambar-tiket.edit');
    }

    public function hapus_user($id)
    {
        // Cari data info tiket berdasarkan ID
        $user = User::findOrFail($id);

        // Hapus data info tiket
        $user->delete();

        // Redirect kembali ke halaman daftar info tiket dengan pesan sukses
        return redirect()->route('info-user')->with('message', 'Data User berhasil dihapus!');
    }

    public function gambar_tiket()
    {
        return view('dashboard.gambar-tiket.index');
    }
}
