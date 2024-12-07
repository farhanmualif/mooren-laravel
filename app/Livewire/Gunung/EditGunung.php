<?php

namespace App\Livewire\Gunung;

use App\Models\Gunung;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Storage;

class EditGunung extends Component
{
    use WithFileUploads;

    public $gunungId; // Ensure this is defined and set appropriately
    public $nama_gunung;
    public $gambar;
    public $gambarLama; // Used to store the old image path
    public $lokasi;
    public $tinggi_gunung;
    public $deskripsi;

    public function mount(Gunung $gunung): void
    {
        // Initialize form fields with existing gunung data
        $this->gunungId = $gunung->id; // Set the gunungId
        $this->nama_gunung = $gunung->nama_gunung;
        $this->gambarLama = $gunung->gambar; // Store the old image path for deletion if needed
        $this->lokasi = $gunung->lokasi;
        $this->tinggi_gunung = $gunung->tinggi_gunung;
        $this->deskripsi = $gunung->deskripsi;
    }

    public function submit(): void
    {
        // Validate the input data
        $this->validate([
            'nama_gunung' => 'required|string|max:255',
            'gambar' => 'nullable|image|max:2048', // Nullable since it's not required to upload a new one
            'lokasi' => 'required|string|max:255',
            'tinggi_gunung' => 'required|numeric', // Ensure this is numeric if needed
            'deskripsi' => 'required',
        ]);

        // Handle image upload if a new image is provided
        if ($this->gambar) {
            // Extract the path from the full URL
            $oldPath = str_replace(url('storage/'), '', $this->gambarLama);

            // Delete the old image if it exists
            if ($oldPath) {
                Storage::disk('public')->delete($oldPath);
            }

            // Store the new image and get the path
            $imagePath = $this->gambar->store('images/gunung', 'public');

            // Dapatkan URL lengkap untuk gambar yang disimpan
            $imageUrl = url(Storage::url($imagePath));
        } else {
            // Use the old image if no new one is uploaded
            $imageUrl = $this->gambarLama;
        }

        // Update the existing gunung
        Gunung::where('id', $this->gunungId)->update([
            'nama_gunung' => $this->nama_gunung,
            'gambar' => $imageUrl,
            'lokasi' => $this->lokasi,
            'tinggi_gunung' => $this->tinggi_gunung,
            'deskripsi' => $this->deskripsi,
        ]);

        session()->flash('message', 'Data gunung berhasil diperbarui.');
        $this->redirectRoute('gunung');
    }

    public function render(): Factory|Application|View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.gunung.edit-gunung');
    }
}
