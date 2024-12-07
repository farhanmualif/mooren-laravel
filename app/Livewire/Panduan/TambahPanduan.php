<?php

namespace App\Livewire\Panduan;

use App\Models\Panduan;
use Livewire\Component;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class TambahPanduan extends Component
{
    use WithFileUploads;

    // Declare properties for form fields
    public $title;
    public $gambar;
    public $informasi;

    public function submit(): void
    {
        // Validate the input data
        $this->validate([
            'title' => 'required|string|max:255',
            'gambar' => 'required|image|max:2048',
            'informasi' => 'required',
        ]);

        // Menyimpan gambar panduan ke storage
        $imagePath = $this->gambar->store('images/panduan', 'public');

       // Dapatkan URL lengkap untuk gambar yang disimpan
       $imageUrl = url(Storage::url($imagePath));

        // Create a new Panduan record, which is related to the selected Gunung
        Panduan::create([
            'title' => $this->title,
            'gambar' => $imageUrl,
            'informasi' => $this->informasi,
        ]);

        session()->flash('message', 'Data panduan berhasil ditambahkan.');
        $this->redirectRoute('panduan');
    }

    public function render(): Factory|Application|View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.panduan.tambah-panduan');
    }
}
