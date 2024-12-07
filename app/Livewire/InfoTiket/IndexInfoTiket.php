<?php

namespace App\Livewire\InfoTiket;

use App\Models\Gunung;
use App\Models\InfoTiket;
use Livewire\Component;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\WithPagination;

class IndexInfoTiket extends Component
{
    use WithPagination;

    public $search = ''; // Properti untuk kata kunci pencarian

    protected $listeners = ['infoTiketCreated' => 'handleInfoTiketCreated', 'infoTiketUpdated' => 'refreshInfoTiket'];

    public function refreshInfoTiket(): void
    {
        $this->render();
    }

    public function handleInfoTiketCreated(): void
    {
        session()->flash('message', 'Data Info Tiket berhasil ditambahkan!');
        $this->render();
    }

    // Reset halaman jika kata kunci berubah
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Method pencarian
    public function searchGunung()
    {
        // Render ulang untuk memperbarui daftar gunung
        $this->render();
    }

    public function render(): Factory|Application|View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        // Ambil data Info Tiket beserta relasi Gunung
        $info_tiket = InfoTiket::query()
            ->when($this->search, function ($query) {
                // Mencari berdasarkan nama gunung atau informasi info tiket
                $query->whereHas('gunung', function ($query) {
                    $query->where('nama_gunung', 'like', '%' . $this->search . '%');
                });
            })
            ->with('gunung')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.info-tiket.index-info-tiket', ['info_tiket' => $info_tiket]);
    }
}
