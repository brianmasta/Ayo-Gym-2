<div>
    <title>Ayo Gym - Non Member</title>
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
                    <li class="breadcrumb-item"><a href="#">Membership</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Non Member</li>
                </ol>
            </nav>
            <h2 class="h4">Data Non Member</h2>
            {{-- <p class="mb-0">Your web analytics dashboard template.</p> --}}
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="/non-member-form" wire:navigate class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Tambah
            </a>
            <div class="btn-group ms-2 ms-lg-3">
                <button type="button" class="btn btn-sm btn-outline-gray-600">Share</button>
                <button type="button" class="btn btn-sm btn-outline-gray-600">Export</button>
            </div>
        </div>
    </div>
    <div class="table-settings mb-4">
        <div class="row justify-content-between align-items-center">
            <div class="col-9 col-lg-8 d-md-flex">
                <div class="input-group me-2 me-lg-3 fmxw-300">
                    <span class="input-group-text">
                        <svg class="icon icon-xs" x-description="Heroicon name: solid/search"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <input type="text" class="form-control" placeholder="Pencarian Non Member" wire:model.live="search">
                </div>
                <div class="input-group me-2 me-lg-3 fmxw-100">
                    <span class="input-group-text">
                        <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z">
                        </path>
                    </svg>
                    </span>
                    <select wire:model.live="perPage" id="perPage" class="form-control" aria-label="Message select example 2">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                    </select>
                </div>
            </div>
            <div class="col-4 col-lg-4 d-flex justify-content-end">
                {{ $nonMember->links() }}
            </div>
        </div>
    </div>
            {{-- Alert database --}}
            @if (session()->has('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
            @endif
    <div class="card card-body shadow border-0 table-wrapper table-responsive">
        <table class="table user-table table-hover align-items-center">
            <thead class="thead-light">
                <tr>
                    <th class="border-bottom">No</th>
                    <th class="border-bottom">Nama</th>
                    <th class="border-bottom">Phone</th>
                    <th class="border-bottom">Kunjungan</th>
                    <th class="border-bottom">Tanggal Kunjungan</th>
                    <th class="border-bottom">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($nonMember as $index => $nonmembers)
                <tr>
                    <td>
                        <span class="fw-normal">{{ $index + 1 }}</span>
                    </td>
                    <td>
                        <span class="fw-normal">{{ $nonmembers->name }}</span>
                    </td>
                    <td>
                        <span class="fw-normal">{{ $nonmembers->phone }}</span>
                    </td>
                    <td>
                        <span class="fw-normal">{{ $nonmembers->visit_purpose }}</span>
                    </td>
                    <td>
                        <span class="fw-normal">{{ $nonmembers->visit_date }}</span>
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
                                <a href="/receipt/{{ $nonmembers->id }}"class="dropdown-item d-flex align-items-center">
                                    <span class="fas fa-user-edit me-2"></span> 
                                    Cetak Resi</a>
                                <button wire:click="edit({{ $nonmembers->id }})" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#editModal">
                                    <span class="fas fa-user-edit me-2"></span> 
                                    Edit
                                </button>
                                <button wire:click="delete({{ $nonmembers->id }})" class="dropdown-item text-danger d-flex align-items-center"
                                    onclick="confirm('Yakin ingin menghapus data ini?') || event.stopImmediatePropagation()">
                                    <span class="fas fa-user-times me-2"></span>
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>                    
                @endforeach

            </tbody>
        </table>
    </div>
    <!-- Modal Edit Non Member -->
    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
                <div class="modal-content">
                    <form wire:submit.prevent="update">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editNonMemberModalLabel">Edit Non Member</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input wire:model="name" type="text" class="form-control" id="name">
                            @error('editNonMember.name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">No Telepon</label>
                            <input wire:model="phone" type="text" class="form-control" id="phone">
                            @error('editNonMember.phone') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="visit_purpose" class="form-label">Catatan</label>
                            <textarea wire:model="visit_purpose" class="form-control" id="visit_purpose" rows="3"></textarea>
                            @error('editNonMember.visit_purpose') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>

        </div>
    </div>
    </div>
    
