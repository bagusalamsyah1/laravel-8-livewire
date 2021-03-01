<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User as TabelUser;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class User extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $user;

    public $ids;
    public $name;
    public $email;
    public $password;
    public $foto;
    public $search;

    protected $rules = [
        'name' => 'required|min:4',
        'email' => 'required|email',
        'password' => 'required|min:4',
        'foto' => 'required|max:9000',
    ];

    protected $messages = [
        'foto.max' => 'Ukuran Foto Max 9000 KB',
        'foto.required' => 'Foto Tidak Boleh Kosong',
        'name.required' => 'Nama Tidak Boleh Kosong',
        'name.min' => 'Nama Min 4 Karakter',
        'email.required' => 'Email Tidak Boleh Kosong',
        'email.email' => 'Bukan Format Email',
        'password.required' => 'password Tidak Boleh Kosong',
        'password.min' => 'password Min 4 Karakter',
    ];

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function ClearForm()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->foto = '';
    }

    public function SimpanData()
    {
        $this->validate();
        $filename = $this->foto->store('foto', 'public');
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'foto' => $filename,
        ];

        TabelUser::insert($data);
        session()->flash('pesan', 'Data Berhasil Disimpan');
        $this->ClearForm();

        $this->emit('adduser');
    }

    public function DetailData($id)
    {
        $user = TabelUser::where('id', $id)->first();
        $this->ids = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->foto = $user->foto;
    }

    public function UpdateData()
    {
        $validasi = $this->validate();
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ];
        TabelUser::where('id', $this->ids)->update($data);
        session()->flash('pesan', 'Data Berhasil Disimpan');
        $this->ClearForm();

        $this->emit('edituser');
    }

    public function DeleteData()
    {
        unlink(public_path('storage/' . $this->foto));
        TabelUser::where('id', $this->ids)->delete();
        session()->flash('hapus', 'Data Berhasil Dihapus');
        $this->ClearForm();

        $this->emit('deleteuser');
    }

    public function render()
    {
        $users = TabelUser::where('name', 'like', '%'.$this->search.'%')
        ->orWhere(
            'name', 'like', '%'.$this->search.'%'
        )
        ->orderBy('id','DESC')->paginate(10);
        return view('livewire.user', ['users' => $users])
        ->extends('layouts.app')
        ->section('content');
    }
}
