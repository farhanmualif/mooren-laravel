<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Gunung;
use App\Models\Tiket;
use App\Models\Pembayaran;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class HomeComponent extends Component
{
    public $totalUsers;
    public $totalGunung;
    public $totalTiket;
    public $totalPenghasilan;
    public $users;

    public function mount()
    {
        // Ambil total data dari masing-masing tabel
        $this->totalUsers = User::count();
        $this->totalGunung = Gunung::count();
        $this->totalTiket = Tiket::count();
        $this->totalPenghasilan = (int) Tiket::where('status_pembayaran', 'success')
            ->sum('total_harga');

        // Ambil semua data user
        $this->users = User::latest()->take(5)->get();
    }

    public function render(): Factory|Application|View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.home-component', [
            'totalUsers' => $this->totalUsers,
            'totalGunung' => $this->totalGunung,
            'totalTiket' => $this->totalTiket,
            'totalPenghasilan' => $this->totalPenghasilan,
            'users' => $this->users,
        ]);
    }
}
