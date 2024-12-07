<?php

namespace App\Livewire\Panduan;

use App\Models\Panduan;
use Livewire\Component;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\WithPagination;

class IndexPanduan extends Component
{
    use WithPagination;

    public $search = ''; // Properti untuk kata kunci pencarian

    protected $listeners = ['panduanCreated' => 'handlePanduanCreated', 'panduanUpdated' => 'refreshPanduan'];

    public function refreshPanduan(): void
    {
        $this->render();
    }

    public function handlePanduanCreated(): void
    {
        session()->flash('message', 'Data Panduan berhasil ditambahkan!');
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
        // Ambil data Panduan beserta relasi Gunung
        $panduan = Panduan::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);

        return view('livewire.panduan.index-panduan', ['panduan' => $panduan]);
    }
}
