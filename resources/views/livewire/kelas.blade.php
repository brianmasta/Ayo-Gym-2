<div>
<title>Ayo Gym Dashboard - Kelas</title>
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
                <li class="breadcrumb-item active" aria-current="page">Kelas</li>
            </ol>
        </nav>
        <h2 class="h4">Daftar Kelas</h2>

    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="/add-kelas" wire:navigate class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
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
                <input type="text" class="form-control" wire:model.live="search" placeholder="Pencarian Kelas">

            </div>
            {{-- <select class="form-select fmxw-200 d-none d-md-inline" aria-label="Message select example 2">
                <option selected>All</option>
                <option value="1">Active</option>
                <option value="2">Inactive</option>
                <option value="3">Pending</option>
                <option value="3">Cancelled</option>
            </select> --}}
        </div>
        <div class="col-4 col-lg-4">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@if (session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif
<div class="card card-body shadow border-0 table-wrapper table-responsive">
    {{-- <div class="d-flex mb-3">
        <select class="form-select fmxw-200" aria-label="Message select example">
            <option selected>Bulk Action</option>
            <option value="1">Send Email</option>
            <option value="2">Change Group</option>
            <option value="3">Delete User</option>
        </select>
        <button class="btn btn-sm px-3 btn-secondary ms-3">Apply</button>
    </div> --}}

    <table class="table user-table table-hover align-items-center">
        <thead>
            <tr>
                <th class="border-bottom">
                    <div class="form-check dashboard-check">
                        <input class="form-check-input" type="checkbox" value="" id="userCheck55">
                        <label class="form-check-label" for="userCheck55">
                        </label>
                    </div>
                </th>
                <th class="border-bottom">No</th>
                <th class="border-bottom">Nama Kelas</th>
                <th class="border-bottom">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $item)
            <tr>
                <td>
                    <div class="form-check dashboard-check">
                        <input class="form-check-input" type="checkbox" value="" id="userCheck1">
                        <label class="form-check-label" for="userCheck1">
                        </label>
                    </div>
                </td>
                <td>
                    <span class="fw-normal">{{ $loop->iteration }}</span>
                </td>
                <td>
                    <span class="fw-normal">{{ $item->name }}</span>
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
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <span class="fas fa-user-shield me-2"></span>
                                Edit
                            </a>
                            <a class="dropdown-item text-danger d-flex align-items-center" href="#">
                                <span class="fas fa-user-times me-2"></span>
                                Delete
                            </a>
                        </div>
                    </div>
                </td>
            </tr>   
            @endforeach
        </tbody>

    </table>
</div>
</div>