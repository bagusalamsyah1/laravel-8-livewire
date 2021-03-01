<div>
   <div class="row">
   <div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            Input Data Staf
        </div>
        <div class="card-body">
        <form wire:submit.prevent="SimpanData">
            <div class="form-group">
                <label>Nama</label>
                <input wire:model="nama" class="form-control">
                @error('nama') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
                <label>Alamat Email</label>
                <input wire:model="email" class="form-control" >
                @error('email') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
            <div class="form-group">
                <label>No Telepon</label>
                <input wire:model="no_telepon" class="form-control" >
                @error('no_telepon') <label class="text-danger">{{ $message }}</label> @enderror
            </div>
      
        <button type="submit" class="btn btn-primary">Submit</button>
        {{ $sukses }}
        </form>
        </div>
        </div>
    </div>
   </div>
</div>
