<?php

namespace App\Livewire\InfoTiket;

use App\Models\Gunung;
use App\Models\InfoTiket;
use Livewire\Component;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class EditInfoTiket extends Component
{

    public $infoTiketId;
    public $id_gunung, $nama_gunung;
    public $weekdays_lokal;
    public $weekend_lokal;
    public $weekdays_asing;
    public $weekend_asing;

    public function mount(InfoTiket $info_tiket): void
    {
        // Initialize form fields with existing gunung data
        $this->infoTiketId = $info_tiket->id; // Set the gunungId
        $this->id_gunung = $info_tiket->id_gunung;
        $this->nama_gunung = $info_tiket->gunung->nama_gunung;
        $this->weekdays_lokal = $info_tiket->weekdays_lokal;
        $this->weekend_lokal = $info_tiket->weekend_lokal;
        $this->weekdays_asing = $info_tiket->weekdays_asing;
        $this->weekend_asing = $info_tiket->weekend_asing;
    }

    public function submit(): void
    {
        // Validate the input data
        $this->validate([
            'id_gunung' => 'required|exists:gunungs,id',
            'weekdays_lokal' => 'required|numeric',
            'weekend_lokal' => 'required|numeric',
            'weekdays_asing' => 'required|numeric',
            'weekend_asing' => 'required|numeric',
        ]);

        // Update the existing info tiket
        InfoTiket::where('id', $this->infoTiketId)->update([
            'id_gunung' => $this->id_gunung,
            'weekdays_lokal' => $this->weekdays_lokal,
            'weekend_lokal' => $this->weekend_lokal,
            'weekdays_asing' => $this->weekdays_asing,
            'weekend_asing' => $this->weekend_asing,
        ]);

        session()->flash('message', 'Data info tiket berhasil diperbarui.');
        $this->redirectRoute('info-tiket');
    }

    public function render(): Factory|Application|View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        // Ambil semua gunung untuk dipilih pada form
        $gunung = Gunung::doesntHave('info_tiket')->get();
        return view('livewire.info-tiket.edit-info-tiket', ['gunung' => $gunung]);
    }
}
