<?php

namespace App\Livewire\GambarTiket;

use App\Models\TicketPhoto;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $gambar;
    public $gambarLama;
    public $gambarTiketId;

    protected $rules = [
        'gambar' => 'nullable|image|max:2048',
    ];

    public function mount()
    {
        // Ambil data gambar dari database saat komponen dimuat
        $gambarTiket = TicketPhoto::first();
        if ($gambarTiket) {
            $this->gambarLama = $gambarTiket->photo_path;
        }
    }

    public function update()
    {
        $this->validate();

        $getGambar = TicketPhoto::all();
        $gambarTiket = $getGambar->first();

        if ($this->gambar) {
            // Hapus gambar lama jika ada
            if ($gambarTiket->gambar && $gambarTiket->gambar !== null) {
                Storage::delete($gambarTiket->gambar);
            }

            // Simpan gambar baru
            // Simpan gambar di storage
            $imagePath = $this->gambar->store('images/tiket', 'public');

            // Dapatkan URL lengkap untuk gambar yang disimpan
            $imageUrl = url(Storage::url($imagePath));

            $gambarTiket->photo_path = $imageUrl;
        }

        $gambarTiket->save();

        session()->flash('message', 'Gambar tiket berhasil diperbarui');
        return redirect()->route('panduan');
    }

    public function handleSave()
    {
        // Logika tambahan jika diperlukan sebelum menyimpan
        $this->update();
        $this->dispatchBrowserEvent('handleSave');
    }

    public function render()
    {
        return view('livewire.gambar-tiket.edit');
    }
}
