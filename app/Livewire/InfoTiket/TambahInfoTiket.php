<?php

namespace App\Livewire\InfoTiket;

use App\Models\Gunung;
use App\Models\InfoTiket;
use Livewire\Component;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class TambahInfoTiket extends Component
{
    public $id_gunung;
    public $weekdays_lokal;
    public $weekend_lokal;
    public $weekdays_asing;
    public $weekend_asing;

    public function submit(): void
    {
        // Validasi input
        $this->validate([
            'id_gunung' => 'required|exists:gunungs,id',
            'weekdays_lokal' => 'required|numeric',
            'weekend_lokal' => 'required|numeric',
            'weekdays_asing' => 'required|numeric',
            'weekend_asing' => 'required|numeric',
        ]);

        // Buat data InfoTiket baru
        InfoTiket::create([
            'id_gunung' => $this->id_gunung,
            'weekdays_lokal' => $this->weekdays_lokal,
            'weekend_lokal' => $this->weekend_lokal,
            'weekdays_asing' => $this->weekdays_asing,
            'weekend_asing' => $this->weekend_asing,
        ]);

        session()->flash('message', 'Data info tiket berhasil ditambahkan.');
        $this->redirectRoute('info-tiket');
    }

    public function render(): Factory|Application|View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        // Ambil semua gunung untuk dipilih pada form
        $gunung = Gunung::doesntHave('info_tiket')->get();

        return view('livewire.info-tiket.tambah-info-tiket', ['gunung' => $gunung]);
    }
}
