<div>
    <title>Ayo Gym Dashboard - Transaksi</title>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="/dashboard">
                            <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="/" wire:navigate>Membership</a></li>
                    <li class="breadcrumb-item"><a href="/Member" wire:navigate>Payment</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
                </ol>
            </nav>
            <h2 class="h4">Transaksi</h2>
            {{-- <p class="mb-0">Your web analytics dashboard template.</p> --}}
        </div>
    </div>

    @if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    {{-- <script>
        swal("success"," {{ session('success') }}", 'success'),{
            button:true,
            button:"OKE",
        }
    </script> --}}

@endif
    <form wire:submit="save">
        @csrf
        <div class="card card-body border-0 shadow mb-4">
            <h2 class="h5 mb-4">Member</h2>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="id_member">ID Member</label>
                    <input type="text" class="form-control" id="id_member" aria-describedby="id_member" name="id_member" wire:model.blur="id_member" required>
                    <small id="nama-kelas" class="form-text text-muted">We'll never share your ID Member with anyone else.</small >
                </div>
                <div class="col-md-3 mb-3">
                    <label for="nama_member">Nama Member</label>
                    <input type="text" class="form-control" id="nama_member" aria-describedby="nama_member" name="nama_member" wire:model.blur="nama_member" required>
                    <small id="nama-kelas" class="form-text text-muted">We'll never share your ID Member with anyone else.</small >
                </div>
                <div class="col-md-3 mb-3">
                    <label for="membership_plan_id">Paket Member</label>
                    <select wire:model="membership_plan_id" id="membership_plan_id" class="form-control">
                        <option value="">- Pilih Paket -</option>
                        @foreach($plans as $plan)
                            <option value="{{ $plan->id }}">{{ $plan->name }} (Rp. {{ number_format($plan->price, 0, ',', '.') }})</option>
                        @endforeach
                    </select>
                    <small id="nama-kelas" class="form-text text-muted">We'll never share your ID Member with anyone else.</small >
                </div>
                <div class="col-md-3 mb-3">
                    <label for="harga_paket">Harga Paket</label>
                    <input type="text" class="form-control" id="harga_paket" aria-describedby="harga_paket" name="harga_paket" wire:model.blur="harga_paket" disabled>
                    <small id="nama-kelas" class="form-text text-muted">We'll never share your ID Member with anyone else.</small >
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="metode_pembayaran">Metode Pembayaran</label>
                    <select wire:model="method" name="metode_pembayaran" id="metode_pembayaran" class="form-control">
                        <option value="">- Pilih Metode -</option>
                        <option value="cash">Cash</option>
                        <option value="online">Online</option>
                    </select>
                    </select>
                    <small id="metode_pembayaran" class="form-text text-muted">We'll never share your ID Member with anyone else.</small >
                </div>
                <div class="col-md-3 mb-3">
                    <label for="bayar">Bayar</label>
                    <input type="text" class="form-control" id="bayar" aria-describedby="bayar" name="bayar" wire:model.blur="bayar" required>
                    <small id="nama-kelas" class="form-text text-muted">We'll never share your ID Member with anyone else.</small >
                </div>
            </div>
            <hr>
            <div class="col-md-6 mb-3">
                <button class="btn btn-success" type="submit">Simpan</button>
                {{-- <button class="btn btn-danger" type="button" >Kembali</button> --}}
                <a class="btn btn-danger" wire:navigate href="/payment">Kembali</a>
            </div>
            <div wire:loading>
                <img src="https://upload.wikimedia.org/wikipedia/commons/c/c7/Loading_2.gif" 
                width="20px">
                Data sedang disimpan...
            </div>
        </div>
    </form>

</div>
