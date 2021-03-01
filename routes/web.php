<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dosen;
use App\Http\Livewire\Mahasiswa;
use App\Http\Livewire\Staf;
use App\Http\Livewire\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dosen', Dosen::class);
Route::get('/mahasiswa', Mahasiswa::class);
Route::get('/staf', Staf::class);
Route::get('/user', User::class);
