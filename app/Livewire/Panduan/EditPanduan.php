<?php

namespace App\Livewire\Panduan;

use App\Models\Panduan;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Storage;

class EditPanduan extends Component
{
    use WithFileUploads;

    public $panduanId; // Ensure this is defined and set appropriately
    public $title;
    public $gambar;
    public $gambarLama;
    public $informasi;

    public function mount(Panduan $panduan): void
    {
        // Initialize form fields with existing gunung data
        $this->panduanId = $panduan->id; // Set the gunungId
        $this->title = $panduan->title;
        $this->gambarLama = $panduan->gambar;
        $this->informasi = $panduan->informasi;
    }

    public function submit(): void
    {
        // Validate the input data
        $this->validate([
            'title' => 'required|string|max:255',
            'gambar' => 'required|image|max:2048',
            'informasi' => 'required',
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
            $imagePath = $this->gambar->store('images/panduan', 'public');

            // Dapatkan URL lengkap untuk gambar yang disimpan
            $imageUrl = url(Storage::url($imagePath));
        } else {
            // Use the old image if no new one is uploaded
            $imageUrl = $this->gambarLama;
        }


        // Update the existing panduan
        Panduan::where('id', $this->panduanId)->update([
            'title' => $this->title,
            'gambar' => $imageUrl,
            'informasi' => $this->informasi,
        ]);

        session()->flash('message', 'Data panduan berhasil diperbarui.');
        $this->redirectRoute('panduan');
    }

    public function render(): Factory|Application|View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.panduan.edit-panduan');
    }
}
