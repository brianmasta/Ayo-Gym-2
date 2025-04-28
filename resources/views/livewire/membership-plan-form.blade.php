    <form wire:submit="save">
        @csrf
        <div class="card card-body border-0 shadow mb-4">
            <h2 class="h4">{{ $planId ? 'Edit Paket' : 'Tambah Paket' }}</h2>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="nama-paket">Nama Paket</label>
                    <input  id="nama-paket" type="text" class="form-control" aria-describedby="nama-paket" wire:model="name">
                    @error('name') <small id="nama-paket" class="form-text" style="color: red">{{ $message }}</small > @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="duration-days">Duration Days</label>
                    <input id="duration-days" type="number" class="form-control" aria-describedby="duration-days" wire:model="duration_days">
                    @error('duration_days') <small id="duration-days" class="form-text" style="color: red">{{ $message }}</small > @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="price">Price</label>
                    <input id="price" type="number" class="form-control" aria-describedby="price" wire:model="price">
                    @error('price') <small id="price" class="form-text" style="color: red">{{ $message }}</small > @enderror
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <button class="btn btn-success" type="submit">Simpan</button>
                {{-- <button class="btn btn-danger" type="button" >Kembali</button> --}}
                <a class="btn btn-danger" wire:navigate type="button" href="/membership-plan">Reset</a>
            </div>
            <div wire:loading>
                <img src="https://upload.wikimedia.org/wikipedia/commons/c/c7/Loading_2.gif" 
                width="20px">
                Data sedang disimpan...
            </div>
        </div>
    </form>

