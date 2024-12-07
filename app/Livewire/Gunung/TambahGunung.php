<?php

namespace App\Livewire\Gunung;

use App\Models\Gunung;
use Livewire\Component;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class TambahGunung extends Component
{
    use WithFileUploads;

    // Declare properties for form fields
    public $nama_gunung;
    public $gambar;
    public $lokasi;
    public $tinggi_gunung;
    public $deskripsi;

    public function submit(): void
    {
        // Validasi data input
        $this->validate([
            'nama_gunung' => 'required|string|max:255',
            'gambar' => 'required|image|max:2048',
            'lokasi' => 'required|string|max:255',
            'tinggi_gunung' => 'required|numeric',
            'deskripsi' => 'required|string',
        ]);

        // Simpan gambar di storage
        $imagePath = $this->gambar->store('images/gunung', 'public');

        // Dapatkan URL lengkap untuk gambar yang disimpan
        $imageUrl = url(Storage::url($imagePath));

        // Simpan data ke database dengan URL gambar
        Gunung::create([
            'nama_gunung' => $this->nama_gunung,
            'gambar' => $imageUrl,
            'lokasi' => $this->lokasi,
            'tinggi_gunung' => $this->tinggi_gunung,
            'deskripsi' => $this->deskripsi,
        ]);

        session()->flash('message', 'Data gunung berhasil ditambahkan.');
        $this->redirectRoute('gunung');
    }

    public function render(): Factory|Application|View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.gunung.tambah-gunung');
    }
}
