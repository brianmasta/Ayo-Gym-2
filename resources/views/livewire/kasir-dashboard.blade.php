<div>
    <div class=" card container py-4">
        <div class="row g-3">
            <!-- Tombol Transaksi Baru -->
            <div class="col-md-3">
                <a href="/member-form" class="btn btn-outline-tertiary w-100 shadow-sm py-5 d-flex flex-column align-items-center">
                    <i class="bi bi-person-plus-fill me-2 fs-1"></i>
                    Member Baru
                </a>
            </div>
            <div class="col-md-3">
                <a href="/non-member-form" class="btn btn-outline-info w-100 shadow-sm py-5 d-flex flex-column align-items-center">
                    <i class="bi bi-person-plus-fill me-2 fs-1"></i>
                    Non Member Baru
                </a>
            </div>
    
            <!-- Tombol Lihat Transaksi -->
            <div class="col-md-3">
                <button class="btn btn-outline-secondary w-100 shadow-sm py-5 d-flex flex-column align-items-center" data-bs-toggle="modal" data-bs-target="#perpanjangModal">
                    <i class="bi bi-receipt-cutoff me-2 fs-1"></i>
                    Perpanjang Paket Member
                </button>
            </div>
    
            <!-- Tombol Laporan Harian -->
            {{-- <div class="col-md-3">
                <a href="/kasir/laporan" class="btn btn-outline-success w-100 shadow-sm py-5">
                    <i class="bi bi-file-earmark-text me-2"></i>
                    Laporan Harian
                </a>
            </div> --}}
    
            <!-- Tombol Keluar / Logout -->
            {{-- <div class="col-md-3">
                <a href="/logout" class="btn btn-outline-danger w-100 shadow-sm py-5">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Keluar
                </a>
            </div> --}}
        </div>
    </div>
    <br>
    <div class="card card-body shadow border-0 table-wrapper table-responsive">
        <table class="table user-table table-hover align-items-center">
            <thead  class="thead-light">
                <tr>
                    <th class="border-bottom">No</th>
                    {{-- <th class="border-bottom">Action</th> --}}
                    <th class="border-bottom">Nama Member</th>
                    <th class="border-bottom">Nama Paket</th>
                    <th class="border-bottom">Amount</th>
                    <th class="border-bottom">Metode</th>
                    <th class="border-bottom">Status</th>
                    <th class="border-bottom">tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $index => $payment)
                <tr>
                    <td>
                        <span class="fw-normal">{{ $index + 1 }}</span>
                    </td>
                    {{-- <td>
                        <div class="btn-group">
                            <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                    </path>
                                </svg>
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
                                <button wire:click="selectForEdit({{ $payment->id }})"
                                    class="dropdown-item d-flex align-items-center">
                                    <span class="fas fa-user-shield me-2"></span>
                                    Edit
                                </button>
                                <button wire:click="delete({{ $payment->id }})"
                                    class="dropdown-item text-danger d-flex align-items-center">
                                    <span class="fas fa-user-times me-2"></span>
                                    Delete
                                </button>
                            </div>
                        </div>
                    </td> --}}
                    <td>
                        <span class="fw-normal">{{ $payment->member->name ?? $payment->nonMember->name ?? 'Tidak Diketahui' }}
                        </span></span>
                    </td>
                    <td>
                        <span class="fw-normal">{{ $payment->membershipPlan->name }}</span>
                    </td>
                    <td>
                        <span class="fw-normal">{{  number_format($payment->amount, 0, ',', '.')}}</span>
                    </td>
                    <td>
                        <span class="fw-normal">{{ $payment->method }}</span>
                    </td>
                    <td>
                        <span class="fw-normal">{{ $payment->status }}</span>
                    </td>
                    <td>
                        <span class="fw-normal">{{ $payment->payment_date }}</span>
                    </td>

                </tr>                    
                @endforeach

            </tbody>
        </table>
    </div>

    <div wire:ignore.self class="modal fade" id="perpanjangModal" tabindex="-1" aria-labelledby="perpanjangModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="perpanjangModalLabel">Perpanjang Paket Member</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                {{-- Alert database --}}
                @if (session()->has('message'))
                <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                </div>
                    @endif
                <div class="mb-3 text-end">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#scanModal">
                        <i class="bi bi-qr-code-scan"></i> Scan QR Member
                    </button>
                </div>
              <div class="input-group mb-3">
                  {{-- <label for="search" class="form-label">Cari Member</label> --}}
                  <input type="text" wire:model.debounce.500ms="search" class="form-control" placeholder="Nama atau ID Member">
                  <button class="btn btn-info" wire:click='searchMember'>Cari</button>
              </div>
      
              @if($selectedMember)
                  <div class="alert alert-secondary">
                      <strong>{{ $selectedMember->name }}</strong><br>
                      ID: {{ $selectedMember->member_code }}<br>
                      Paket Aktif: {{ $selectedMember->membershipPlan->name }}<br>
                      Expired: {{ $selectedMember->end_date }}
                  </div>
      
                  <div class="mb-3">
                      <label for="membership_plan_id" class="form-label">Pilih Paket Baru</label>
                      <select wire:model="membership_plan_id" class="form-select">
                          <option value="">-- Pilih Paket --</option>
                          @foreach($plans as $plan)
                              <option value="{{ $plan->id }}">{{ $plan->name }} - Rp{{ number_format($plan->price) }}</option>
                          @endforeach
                      </select>
                  </div>
      
                  <div class="mb-3">
                      <label for="method" class="form-label">Metode Pembayaran</label>
                      <select wire:model="method" class="form-select">
                          <option value="">-- Pilih Metode --</option>
                          <option value="cash">Tunai</option>
                          <option value="online">Midtrans</option>
                      </select>
                  </div>
              @endif
      
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button wire:click="proceed" wire:loading.attr="disabled" wire:target="proceed" class="btn btn-success">
                <span wire:loading.remove wire:target="proceed">Perpanjang</span>
                <span wire:loading wire:target="proceed">
                    <span class="spinner-border spinner-border-sm"></span> Proses...
                </span>
            </button>
            </div>
          </div>
        </div>
      </div>
      <div wire:ignore.self class="modal fade" id="scanModal" tabindex="-1" aria-labelledby="scanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Scan QR Member</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
              <div id="reader" style="width: 100%"></div>
            </div>
          </div>
        </div>
      </div>
        {{-- Scan perpanjang member --}}
        @push('scripts')

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
            window.open(`/receipt-member/${orderId}`, '_blank');
            window.location.href = "/kasir-dashboard";
        });

    });
        </script>
        <script>
            let scanner;
            let scanned = false;
            const beepSound = new Audio('/assets/sounds/scanner.mp3');

            const modalScan = document.getElementById('scanModal');

            modalScan.addEventListener('shown.bs.modal', () => {
                scanned = false;

                scanner = new Html5Qrcode("reader");
                scanner.start(
                    { facingMode: "environment" },
                    {
                        fps: 10,
                        qrbox: 200
                    },
                    qrCodeMessage => {
                        if (!scanned) {
                            scanned = true;
                            beepSound.play(); // Bunyikan beep saat QR code berhasil terbaca

                            Livewire.dispatch('qrScanned', {
                                data: { memberId: qrCodeMessage }
                            });

                            scanner.stop().then(() => {
                                bootstrap.Modal.getInstance(modalScan).hide();
                            });
                        }
                    },
                    errorMessage => {
                        // Error log (tidak mengganggu)
                    }
                );
            });

            modalScan.addEventListener('hidden.bs.modal', async () => {
                
                // Hilangkan fokus SEBELUM proses lainnya
                if (document.activeElement) {
                    document.activeElement.blur();
                }

                if (scanner) {
                    try {
                        await scanner.stop();
                        await scanner.clear();
                    } catch (error) {
                        console.warn('Gagal stop scanner:', error);
                    }
                }
            });

            modalScan.addEventListener('hidden.bs.modal', () => {
                modalScan.setAttribute('inert', '');
            });
            modalScan.addEventListener('shown.bs.modal', () => {
                modalScan.removeAttribute('inert');
            });

            
        </script>
          @endpush
</div>
