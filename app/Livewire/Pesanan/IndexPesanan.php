<?php

namespace App\Livewire\Pesanan;

use App\Models\Tiket;
use Livewire\Component;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\WithPagination;

class IndexPesanan extends Component
{
    use WithPagination;

    public $search = ''; // Properti untuk kata kunci pencarian

    protected $listeners = ['pesananUpdated' => 'refreshPesanan'];

    public function refreshPesanan(): void
    {
        $this->render();
    }

    // Reset halaman jika kata kunci berubah
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Method pencarian
    public function searchPesanan()
    {
        // Render ulang untuk memperbarui daftar gunung
        $this->render();
    }

    public function render(): Factory|Application|View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        // Ambil data Panduan beserta relasi Gunung
        $tiket = Tiket::query()
            ->when($this->search, function ($query) {
                $query->where('kode_tiket', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.pesanan.index-pesanan', ['tiket' => $tiket]);
    }
}
