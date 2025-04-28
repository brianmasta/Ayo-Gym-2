<div>
    <title>Ayo Gym Dashboard - Non Member Register</title>
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
                    <li class="breadcrumb-item"><a href="/Member" wire:navigate>Non Member</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Non Member Register</li>
                </ol>
            </nav>
            <h2 class="h4">Registrasi Non Member</h2>
            {{-- <p class="mb-0">Your web analytics dashboard template.</p> --}}
        </div>
    </div>
    <form wire:submit.prevent="submit">
        @csrf
        <div class="card card-body border-0 shadow mb-4">
            <h2 class="h5 mb-4">Non Member Register</h2>
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
                <div class="col-md-3 mb-3">
                    <label for="phone">Phone</label>
                    <input type="number" class="form-control" placeholder="Phone" wire:model="phone">
                    @error('phone') <small id="phone" class="form-text" style="color: red">{{ $message }}</small > @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="visit_purpose">Keterangan Kunjungan</label>
                    <input type="text" class="form-control" id="visit_purpose" aria-describedby="visit_purpose" placeholder="Keterangan Kunjungan" wire:model="visit_purpose">
                    @error('visit_purpose') <small id="visit_purpose" class="form-text" style="color: red">{{ $message }}</small > @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="membership_plan_id">Paket</label>
                    <select wire:model="membership_plan_id" id="membership_plan_id" class="form-control">
                        <option value="">- Pilih Paket -</option>
                        @foreach($membershipPlans as $plan)
                            <option value="{{ $plan->id }}">{{ $plan->name }} (Rp. {{ number_format($plan->price, 0, ',', '.') }})</option>
                        @endforeach
                    </select>
                    @error('membership_plan_id') <small id="membership_plan_id" class="form-text" style="color: red">{{ $message }}</small > @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="method">Metode Pembayaran</label>
                    <select wire:model="method" id="method" class="form-control">
                        <option value="">-Pilih-</option>
                        <option value="cash">Cash</option>
                        <option value="online">Online</option>
                    </select>
                    @error('membership_plan_id') <small id="membership_plan_id" class="form-text" style="color: red">{{ $message }}</small > @enderror
                </div>
            </div>
            <hr>
            <div class="col-md-6 mb-3">
                <button class="btn btn-success" type="submit">Simpan</button>
                <a class="btn btn-danger" wire:navigate 
                @can('admin')
                href="/non-member"
                @endcan
                @can('kasir')
                href="/kasir-dashboard"
                @endcan
                >Kembali</a>
                {{-- <button class="btn btn-danger" type="button">Kembali</button> --}}
                {{-- <button type="button" class="btn btn-warning" wire:click="resetForm">Reset Data</button> --}}
            </div>
        </div>
    </form>
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

        Livewire.on('open-receipt', ({ orderId }) => {
            if (!orderId) {
                alert("Order ID tidak ditemukan");
                return;
            }
            window.open(`/receipt/${orderId}`, '_blank');
            window.location.href = "/non-member";
        });

    });
    </script>
</div>




