<div>
        <!-- Toast Notification -->
        <div class="toast-container  position-fixed top-0 end-0 p-3" id="toast-container">
            <div class="toast text-bg-primary" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Berhasil</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Password berhasil diubah.
                </div>
            </div>
        </div>
    <title>Ayo Gym - Manage Users</title>
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
                    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Users</li>
                </ol>
            </nav>

            {{-- <p class="mb-0">Your web analytics dashboard template.</p> --}}
        </div>
    </div>
    <div class="table-settings mb-4">
        <div class="row justify-content-between align-items-center">
            <div class="col-9 col-lg-8 d-md-flex">
                <h2 class="h4">Manage Users</h2>
            </div>
            {{-- <div class="col-3 col-lg-4 d-flex justify-content-end">
                <div class="input-group me-2 me-lg-3 fmxw-300">
                    <span class="input-group-text">
                        <svg class="icon icon-xs" x-description="Heroicon name: solid/search"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <input type="text" class="form-control" placeholder="Pencarian Membership Plan">
                </div>
            </div> --}}
        </div>
    </div>
    @if (session()->has('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
    </div>
    @endif
    <form wire:submit.prevent="{{ $isEditing ? 'update' : 'save' }}">
        @csrf
        <div class="card card-body border-0 shadow mb-4">
            <h2 class="h4">{{ $isEditing ? 'Edit Users' : 'Tambah Users' }}</h2>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="first_name">First Name</label>
                    <input  id="first_name" type="text" class="form-control" placeholder="First Name" wire:model="first_name">
                    @error('first_name') <small id="first_name" class="form-text" style="color: red">{{ $message }}</small > @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="last_name">Last Name</label>
                    <input  id="last_name" type="text" class="form-control" placeholder="Last Name" wire:model="last_name">
                    @error('last_name') <small id="last_name" class="form-text" style="color: red">{{ $message }}</small > @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="email">Email</label>
                    <input  id="email" type="email" class="form-control" placeholder="email" wire:model="email">
                    @error('email') <small id="email" class="form-text" style="color: red">{{ $message }}</small > @enderror
                </div>
                @if (!$isEditing)
                <div class="col-md-3 mb-3">
                    <label for="password">Password</label>
                    <input  id="password" type="password" class="form-control" placeholder="Password" wire:model="password">
                    @error('password') <small id="password" class="form-text" style="color: red">{{ $message }}</small > @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="password_confirmation">Password Confirmation</label>
                    <input  id="password_confirmation" type="password" class="form-control" placeholder="Password Confirmation" wire:model="password_confirmation">
                    @error('password_confirmation') <small id="password_confirmation" class="form-text" style="color: red">{{ $message }}</small > @enderror
                </div>
                @endif
            </div>

            <div class="col-md-6 mb-3">
                <button class="btn btn-success" type="submit">
                    {{ $isEditing ? 'Update' : 'Tambah' }}
                </button>
                @if ($isEditing)
                <button type="button" wire:click="resetForm" class="btn btn-danger">Batal</button>
                @endif
            </div>
        </div>
    </form>

    
    <div class="card card-body shadow border-0 table-wrapper table-responsive">
        <table class="table user-table table-hover align-items-center">
            <thead  class="thead-light">
                <tr>
                    <th class="border-bottom">No</th>
                    <th class="border-bottom">Action</th>
                    <th class="border-bottom">First Name</th>
                    <th class="border-bottom">Last Name</th>
                    <th class="border-bottom">Email</th>
                    <th class="border-bottom">Role</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $user)
                <tr>
                    <td>
                        <span class="fw-normal">{{ $index + 1 }}</span>
                    </td>
                    <td>
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
                                <button wire:click="edit({{ $user->id }})"
                                    class="dropdown-item d-flex align-items-center">
                                    <span class="fas fa-user-shield me-2"></span>
                                    Edit
                                </button>
                                <button wire:click="edit({{ $user->id }})"
                                    class="dropdown-item d-flex align-items-center"
                                    wire:click="showPasswordModal({{ $user->id }})"
                                    data-bs-toggle="modal"
                                    data-bs-target="#passwordModal">
                                    <span class="fas fa-user-shield me-2"></span>
                                    Ganti Password
                                </button>
                                <button wire:click="delete({{ $user->id }})" onclick="return confirm('Yakin hapus user ini?')"
                                    class="dropdown-item text-danger d-flex align-items-center">
                                    <span class="fas fa-user-times me-2"></span>
                                    Delete
                                </button>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="fw-normal">{{ $user->first_name }}</span>
                    </td>
                    <td>
                        <span class="fw-normal">{{ $user->last_name }}</span>
                    </td>
                    <td>
                        <span class="fw-normal">{{ $user->email }}</span>
                    </td>
                    <td>
                        <span class="fw-normal">{{ $user->role }}</span>
                    </td>
                </tr>                    
                @endforeach

            </tbody>
        </table>
    </div>

    <!-- Modal Ganti Password -->

<div wire:ignore.self class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="passwordModalLabel">Ganti Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <input wire:model.defer="password" type="password" class="form-control" placeholder="Password Baru">
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
          <div class="mb-3">
            <input wire:model.defer="password_confirmation" type="password" class="form-control" placeholder="Konfirmasi Password">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="button" wire:click="updatePassword" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
  </div>
  @push('scripts')
  <script>
      window.addEventListener('close-modal', function () {
          const modalElement = document.getElementById('passwordModal');
          if (modalElement) {
              // Cek apakah modal sudah ada dan jika sudah, tutup modal
              const modal = bootstrap.Modal.getInstance(modalElement);
              if (modal) {
                  modal.hide();  // Menutup modal menggunakan Bootstrap
              }
          }
      });

      window.addEventListener('show-toast', function (event) {
        var toastEl = document.querySelector('.toast');
            var toast = new bootstrap.Toast(toastEl);

            // Menambahkan kelas berdasarkan tipe yang dikirimkan
            if (event.detail.type === 'success') {
                toastEl.style.backgroundColor = '#28a745';  // Hijau sukses
            } else if (event.detail.type === 'error') {
                toastEl.style.backgroundColor = '#dc3545';  // Merah error
            } else {
                toastEl.style.backgroundColor = '#007bff';  // Biru informasi
            }

            toast.show();

            // Menyembunyikan toast setelah 5 detik
            setTimeout(() => {
                toast.hide();
            }, 5000);
        });
  </script>
  @endpush
</div>
