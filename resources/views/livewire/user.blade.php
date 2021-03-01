<div class="col-sm-12">
  <div class="card">
    <div class="card-header">
      Data User
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adduser">
        Add User
      </button>
    </div>
    <div class="card-body">
      @if (session('pesan'))
      <div class="alert alert-success">
          {{ session('pesan') }}
      </div>
      @endif
      @if (session('hapus'))
      <div class="alert alert-danger">
          {{ session('hapus') }}
      </div>
      @endif
      <div class="row">
        <div class="col-sm-6">
          <input wire:model="search" type="text" placeholder="Pencarian.." class="form-control" >
        </div>
      </div>
      <br>
    <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Foto</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
    <?php $no=1; ?>
      @foreach ($users as $data)
      <tr>
        <th>{{ $no++ }}</th>
        <td>{{ $data->name }}</td>
        <td>{{ $data->email }}</td>
        <td><img src="{{ asset('storage') }}/{{ $data->foto }}" width="150px" ></td>
        <td>
        <button wire:click.prevent="DetailData( {{ $data->id }} )" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edituser">Edit</button>
        <button wire:click.prevent="DetailData( {{ $data->id }} )" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteuser">Delete</button>
        </td>
      </tr>
      @endforeach
    
    </tbody>
  </table>
  {{ $users->links() }}
    </div>
  </div>

  <!-- Modal Add-->
  <div wire:ignore.self class="modal fade" id="adduser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Data User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
              <div class="form-group">
                  <label>Nama</label>
                  <input name="name" wire:model="name" class="form-control">
                  @error('name') <label class="text-danger">{{ $message }}</label> @enderror
              </div>
              <div class="form-group">
                  <label>Alamat Email</label>
                  <input name="email" wire:model="email" class="form-control" >
                  @error('email') <label class="text-danger">{{ $message }}</label> @enderror
              </div>
              <div class="form-group">
                  <label>Password</label>
                  <input name="password" wire:model="password" class="form-control" >
                  @error('password') <label class="text-danger">{{ $message }}</label> @enderror
              </div>
              <div class="form-group">
                  <label>Foto</label>
                  <input type="file" name="foto" wire:model="foto" class="form-control" >
                  @error('foto') <label class="text-danger">{{ $message }}</label> @enderror
              </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" wire:click.prevent="SimpanData()">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Edit-->
  <div wire:ignore.self class="modal fade" id="edituser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Data User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card-body">
            @if (session('pesan'))
            <div class="alert alert-success">
                {{ session('pesan') }}
            </div>
            @endif
          <form>
              <div class="form-group">
                  <label>Nama</label>
                  <input name="name" wire:model="name" class="form-control">
                  @error('name') <label class="text-danger">{{ $message }}</label> @enderror
              </div>
              <div class="form-group">
                  <label>Alamat Email</label>
                  <input name="email" wire:model="email" class="form-control" >
                  @error('email') <label class="text-danger">{{ $message }}</label> @enderror
              </div>
              <div class="form-group">
                  <label>Password</label>
                  <input name="password" wire:model="password" class="form-control" >
                  @error('password') <label class="text-danger">{{ $message }}</label> @enderror
              </div>
        
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" wire:click.prevent="UpdateData()">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Delete-->
  <div wire:ignore.self class="modal fade" id="deleteuser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Data User ({{ $name }})</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            @if (session('pesan'))
            <div class="alert alert-success">
                {{ session('pesan') }}
            </div>
            @endif
            <form>
          yakin ingin menghapus data?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger" wire:click.prevent="DeleteData()">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    window.livewire.on('adduser',()=>{
      $('#adduser').modal('hide');
    });

    window.livewire.on('edituser',()=>{
      $('#edituser').modal('hide');
    });

    window.livewire.on('deleteuser',()=>{
      $('#deleteuser').modal('hide');
    });
  </script>
</div>
