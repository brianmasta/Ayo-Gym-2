<div>
    <title>Ayo Gym Dashboard - Registrasi Member</title>
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
                    <li class="breadcrumb-item"><a href="/Member" wire:navigate>Daftar Member</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Register Member</li>
                </ol>
            </nav>
            <h2 class="h4">Registrasi Member</h2>
            {{-- <p class="mb-0">Your web analytics dashboard template.</p> --}}
        </div>
    </div>
    <form wire:submit.prevent="submit">
        @csrf
        <div class="card card-body border-0 shadow mb-4">
            <h2 class="h5 mb-4">Data Diri Member</h2>
            {{-- Alert database --}}
            @if (session()->has('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
            @endif
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" wire:model="name" placeholder="Nama">
                    @error('name') <small id="name" class="form-text" style="color: red">{{ $message }}</small > @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email_member">Email</label>
                    <input type="email" class="form-control" id="email_member" placeholder="Alamat Email" wire:model="email">
                    @error('email') <small id="email" class="form-text" style="color: red">{{ $message }}</small > @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="phone">Phone</label>
                    <input type="number" class="form-control" placeholder="Phone" wire:model="phone">
                    @error('phone') <small id="phone" class="form-text" style="color: red">{{ $message }}</small > @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="birthdate">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tgl_lahir" aria-describedby="tgl_lahir" placeholder="Tanggal Lahir" wire:model="birthdate">
                    @error('birthdate') <small id="birthdate" class="form-text" style="color: red">{{ $message }}</small > @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="address">Alamat</label>
                    <input type="text" class="form-control" id="address" aria-describedby="alamat_member" placeholder="Alamat" wire:model="address">
                    @error('address') <small id="address" class="form-text" style="color: red">{{ $message }}</small > @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="gender">Gender</label>
                    <select wire:model="gender" name="gender" id="gender" class="form-control">
                        <option value="">- Pilih Gender -</option>
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                    </select>
                    @error('gender') <small id="address" class="form-text" style="color: red">{{ $message }}</small > @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="join_date">Join Date</label>
                    <input type="date" class="form-control" id="join_date" aria-describedby="join_date" placeholder="Tanggal Bergabung" wire:model="join_date">
                    @error('join_date') <small id="join_date" class="form-text" style="color: red">{{ $message }}</small > @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="membership_plan_id">Paket</label>
                    <select wire:model="membership_plan_id" id="membership_plan_id" class="form-control">
                        <option value="">- Pilih Paket -</option>
                        @foreach($membershipPlan as $plan)
                            <option value="{{ $plan->id }}">{{ $plan->name }} (Rp. {{ number_format($plan->price, 0, ',', '.') }})</option>
                        @endforeach
                    </select>
                    @error('membership_plan_id') <small id="membership_plan_id" class="form-text" style="color: red">{{ $message }}</small > @enderror
                </div>
            <hr>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="method">Metode Pembayaran</label>
                    <select class="form-control" id="method" wire:model="method">
                        <option value="">- Pilih Metode -</option>
                        <option value="cash">Cash</option>
                        <option value="midtrans">Midtrans</option>
                    </select>
                    @error('method') <small class="form-text text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
            </div>
            <hr>
            <div class="col-md-6 mb-3">
                <button type="button" class="btn btn-success" wire:click="openModal" data-bs-toggle="modal" data-bs-target="#confirmModal">
                    Simpan
                </button>
                <a class="btn btn-danger" wire:navigate 
                @can('admin')
                href="/member" 
                @endcan
                @can('kasir')
                href="/kasir-dashboard"
                @endcan
                >Kembali</a>
                {{-- <button class="btn btn-danger" type="button">Kembali</button> --}}
                <button type="button" class="btn btn-warning" wire:click="resetForm">Reset Data</button>
            </div>
        </div>
    </form>
<!-- Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Data Member</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <ul>
            <li><strong>Nama:</strong> {{ $name }}</li>
            <li><strong>Email:</strong> {{ $email }}</li>
            <li><strong>No HP:</strong> {{ $phone }}</li>
            <li><strong>Tanggal Lahir:</strong> {{ $birthdate }}</li>
            <li><strong>Alamat:</strong> {{ $address }}</li>
            <li><strong>Gender:</strong> {{ $gender }}</li>
            <li><strong>Join Date:</strong> {{ $join_date }}</li>
            <li><strong>Paket:</strong> {{ $this->membershipPlanDetails }}</li>
            <li><strong>Metode Pembayaran:</strong> {{ $method }}</li>
          </ul>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button class="btn btn-primary" wire:click="confirmSubmit">Ya, Simpan</button>
        </div>
      </div>
    </div>
  </div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    document.addEventListener("livewire:navigated", function () {
        Livewire.on('showSnap', (data) => {
            const token = typeof data === 'object' && data.token ? data.token : data;
            console.log("Token:", token);
            window.snap.pay(token, {
                onSuccess: function(result){ 
                    console.log('Success', result);
                    Livewire.dispatch('midtransSuccess', { result: result });
                },
                onPending: function(result){ console.log('Pending', result); },
                onError: function(result){ console.log('Error', result); },
                onClose: function(){ console.log('User closed the popup'); }
            });
        });

        Livewire.on('open-receipt-member', ({ orderId }) => {
            if (!orderId) {
                alert("Order ID tidak ditemukan");
                return;
            }

            let userRole = "{{ auth()->user()->role }}";

            window.open(`/receipt-member/${orderId}`, '_blank');

            if (userRole === "/member") {
            window.location.href = "/dashboard-admin";
            } else {
                window.location.href = "/kasir-dashboard";
            }

            // window.location.href = "/member";
        });

    });
</script>
</div>




