<?php

namespace App\Livewire\Pembayaran;

use App\Models\Pembayaran;
use App\Models\Tiket;
use Livewire\Component;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\WithPagination;

class IndexPembayaran extends Component
{
    use WithPagination;

    public $search = ''; // Properti untuk kata kunci pencarian

    protected $listeners = ['pembayaranCreated' => 'handlePembayaranCreated', 'pembayaranUpdated' => 'refreshPembayaran'];

    public function refreshPembayaran(): void
    {
        $this->render();
    }

    public function handlePembayaranCreated(): void
    {
        session()->flash('message', 'Data Pembayaran berhasil ditambahkan!');
        $this->render();
    }

    // Reset halaman jika kata kunci berubah
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Method pencarian
    public function searchPembayaran()
    {
        // Render ulang untuk memperbarui daftar gunung
        $this->render();
    }

    public function render(): Factory|Application|View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        // Ambil data Panduan beserta relasi Gunung
        $pembayaran = Pembayaran::query()
            ->when($this->search, function ($query) {
                $query->whereHas('tikets', function ($query) {
                    $query->where('kode_tiket', 'like', '%' . $this->search . '%');
                });
            })
            ->with('tikets')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.pembayaran.index-pembayaran', ['pembayaran' => $pembayaran]);
    }
}
