<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Dosen extends Component
{
    public function render()
    {
        $data = [
            'nama' => 'umpung',
            'alamat' => 'depok',
            'prodi' => 'ilmu komputer'
        ];
        return view('livewire.dosen', $data)
        ->extends('layouts.app')
        ->section('content');
    }
}
