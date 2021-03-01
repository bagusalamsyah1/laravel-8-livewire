<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Mahasiswa extends Component
{
    public function render()
    {
        return view('livewire.mahasiswa')
        ->extends('layouts.app')
        ->section('content');
    }
}
