<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Staf extends Component
{
    public $nama;
    public $email;
    public $no_telepon;

    public $sukses;

    protected $rules = [
        'nama' => 'required|min:6',
        'email' => 'required|email',
        'no_telepon' => 'required|min:12',
    ];

    protected $messages = [
        'nama.required' => 'Nama Tidak Boleh Kosong',
        'nama.min' => 'Nama Min 6 Karakter',
        'email.required' => 'Email Tidak Boleh Kosong',
        'email.email' => 'Bukan Format Email',
        'no_telepon.required' => 'No Telepon Tidak Boleh Kosong',
        'no_telepon.min' => 'No Telepon Min 12 Karakter',
    ];

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function SimpanData()
    {
        $this->validate();

        $this->sukses = 'Data Berhasil Di Simpan';

    }

    public function render()
    {
        return view('livewire.staf',)
        ->extends('layouts.app')
        ->section('content');
    }
}
