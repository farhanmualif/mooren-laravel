<?php

namespace App\Livewire\Pembayaran;

use App\Models\Pembayaran;
use App\Models\Tiket;
use Livewire\Component;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class TambahPembayaran extends Component
{
    public $id_tiket;
    public $kode_tiket;
    public $user;
    public $nama_gunung;
    public $tgl_masuk;
    public $tgl_keluar;
    public $total_harga;
    public $jumlah;
    public $tgl_pembayaran;
    public $metode_pembayaran;
    public $status = 'Belum Dibayar';

    // Method untuk mencari tiket berdasarkan kode
    public function updatedKodeTiket()
    {
        $tiket = Tiket::where('kode_tiket', $this->kode_tiket)->first();

        if ($tiket) {
            $this->id_tiket = $tiket->id;
            $this->user = $tiket->user->name;
            $this->nama_gunung = $tiket->gunung->nama_gunung;
            $this->tgl_masuk = $tiket->tgl_masuk;
            $this->tgl_keluar = $tiket->tgl_keluar;
            $this->total_harga = $tiket->total_harga;
            $this->jumlah = $this->total_harga;
        } else {
            $this->reset(['id_tiket', 'user', 'nama_gunung', 'tgl_masuk', 'tgl_keluar', 'total_harga', 'jumlah']);
        }
    }

    public function submit(): void
    {
        // Validasi input
        $this->validate([
            'id_tiket' => 'required',
            'tgl_pembayaran' => 'required|date',
            'jumlah' => 'required|numeric',
            'metode_pembayaran' => 'required|string',
            'status' => 'required|string',
        ]);

        // Membuat pembayaran baru
        $pembayaran = Pembayaran::create([
            'id_tiket' => $this->id_tiket,
            'tgl_pembayaran' => now('Asia/Jakarta'),
            'jumlah' => $this->jumlah,
            'metode_pembayaran' => $this->metode_pembayaran,
            'status' => $this->status,
        ]);

        // Perbarui status pembayaran di tabel Tiket jika status pembayaran berhasil
        if ($pembayaran->status === 'Sudah Dibayar') {
            Tiket::where('id', $this->id_tiket)
                ->update(['status_pembayaran' => 'success']);
        }

        // Tampilkan notifikasi dan reset form
        session()->flash('message', 'Data pembayaran berhasil ditambahkan.');
        $this->redirectRoute('pembayaran');
    }

    public function render(): Factory|Application|View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.pembayaran.tambah-pembayaran');
    }
}
