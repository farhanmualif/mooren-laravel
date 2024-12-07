<?php

namespace App\Livewire\Gunung;

use App\Models\Gunung;
use Livewire\Component;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\WithPagination;

class IndexGunung extends Component
{
    use WithPagination;

    public $search = ''; // Properti untuk kata kunci pencarian

    protected $listeners = ['gunungCreated' => 'handleGunungCreated', 'gunungUpdated' => 'refreshGunung'];

    public function refreshGunung(): void
    {
        $this->render();
    }

    public function handleGunungCreated(): void
    {
        session()->flash('message', 'Data Gunung berhasil ditambahkan!');
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
        $gunung = Gunung::query()
            ->when($this->search, function ($query) {
                $query->where('nama_gunung', 'like', '%' . $this->search . '%')
                    ->orWhere('lokasi', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.gunung.index-gunung', ['gunung' => $gunung]);
    }
}

