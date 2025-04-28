<div>
    <div class="container my-4">
        <div class="card shadow-sm p-3">
            <h4 class="mb-3 fw-semibold">Verifikasi Data Member</h4>
    
            @php
                $memberData = session('member_data');
                $membershipPlan = \App\Models\MembershipPlan::find($memberData['membership_plan_id']);
            @endphp
    
            <form>
                <div class="row g-2">
                    <div class="col-md-6">
                        <label class="form-label">ID Member</label>
                        <input type="text" class="form-control form-control-sm" value="{{ $memberData['member_code'] }}" readonly>
                    </div>
    
                    <div class="col-md-6">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control form-control-sm" value="{{ $memberData['name'] }}" readonly>
                    </div>
    
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control form-control-sm" value="{{ $memberData['email'] }}" readonly>
                    </div>
    
                    <div class="col-md-6">
                        <label class="form-label">Telepon</label>
                        <input type="text" class="form-control form-control-sm" value="{{ $memberData['phone'] }}" readonly>
                    </div>
    
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="text" class="form-control form-control-sm" value="{{ $memberData['birthdate'] }}" readonly>
                    </div>
    
                    <div class="col-md-6">
                        <label class="form-label">Gender</label>
                        <input type="text" class="form-control form-control-sm" value="{{ $memberData['gender'] === 'L' ? 'Laki-Laki' : 'Perempuan' }}" readonly>
                    </div>
    
                    <div class="col-12">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control form-control-sm" rows="2" readonly>{{ $memberData['address'] }}</textarea>
                    </div>
    
                    <div class="col-md-6">
                        <label class="form-label">Paket</label>
                        <input type="text" class="form-control form-control-sm" value="{{ $membershipPlan->name }} - Rp. {{ number_format($membershipPlan->price, 0, ',', '.') }}" readonly>
                    </div>
    
                    <div class="col-md-6" x-data="{ method: @entangle('method') }">
                        <label class="form-label">Metode Pembayaran</label>
                        <select x-model="method" class="form-select form-select-sm mb-1">
                            <option value="">-- Pilih Metode --</option>
                            <option value="cash">Cash</option>
                            <option value="online">Online</option>
                        </select>
    
                        <template x-if="method === 'cash'">
                            <input type="number" wire:model="amount" class="form-control form-control-sm mt-1" placeholder="Jumlah Cash">
                        </template>
    
                        <template x-if="method === 'online'">
                            <button wire:click="checkout" class="btn btn-outline-primary btn-sm mt-1 w-100">
                                Bayar Online
                            </button>
                        </template>
                    </div>
    
                    <div class="col-md-6">
                        <label class="form-label">Start Paket</label>
                        <input type="text" class="form-control form-control-sm" value="{{ $memberData['join_date'] }}" readonly>
                    </div>
    
                    <div class="col-md-6">
                        <label class="form-label">Paket Expire</label>
                        <input type="text" class="form-control form-control-sm" value="{{ $memberData['expire_date'] }}" readonly>
                    </div>
    
                    <div class="col-md-6">
                        <label class="form-label">Total Bayar</label>
                        <input type="text" class="form-control form-control-sm fw-bold text-success" value="Rp. {{ number_format($member['amount'], 0, ',', '.') }}" readonly>
                    </div>
    
                    @if (session()->has('message'))
                        <div class="col-12">
                            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                </div>
    
                <div class="d-flex justify-content-between mt-3">
                    <template x-if="method === 'cash'">
                        <button wire:click="simpan" type="button" class="btn btn-success btn-sm px-4">Simpan</button>
                    </template>
                    <template x-if="method !== 'cash'">
                        <button disabled class="btn btn-success btn-sm px-4">Menunggu Pembayaran</button>
                    </template>
                    <a href="{{ route('member-form') }}" class="btn btn-secondary btn-sm px-4">Kembali</a>
                </div>
            </form>
        </div>
    </div>
{{-- </form> --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    Livewire.on('showSnap', (data) => {
        const token = typeof data === 'object' && data.token ? data.token : data;
        console.log("Token:", token);
        window.snap.pay(token, {
            onSuccess: function(result){ 
                console.log('Success', result);
                Livewire.dispatch('midtransSuccess', result);
            },
            onPending: function(result){ console.log('Pending', result); },
            onError: function(result){ console.log('Error', result); },
            onClose: function(){ console.log('User closed the popup'); }
        });
    });
</script>
</div>