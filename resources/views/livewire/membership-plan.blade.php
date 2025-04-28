<div>
    <title>Ayo Gym - Membership Plan</title>
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
                    <li class="breadcrumb-item active" aria-current="page">Membership Plan</li>
                </ol>
            </nav>

            {{-- <p class="mb-0">Your web analytics dashboard template.</p> --}}
        </div>
    </div>
    <div class="table-settings mb-4">
        <div class="row justify-content-between align-items-center">
            <div class="col-9 col-lg-8 d-md-flex">
                <h2 class="h4">Membership Plan</h2>
            </div>
            <div class="col-3 col-lg-4 d-flex justify-content-end">
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
            </div>
        </div>
    </div>
    @if (session()->has('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
    </div>
    @endif
    @livewire('membership-plan-form', ['planId' => $selectedPlanId], key($selectedPlanId ?? 'new'))
    <div class="card card-body shadow border-0 table-wrapper table-responsive">
        <table class="table user-table table-hover align-items-center">
            <thead  class="thead-light">
                <tr>
                    <th class="border-bottom">No</th>
                    <th class="border-bottom">Action</th>
                    <th class="border-bottom">Nama Paket</th>
                    <th class="border-bottom">Duration Days</th>
                    <th class="border-bottom">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plans as $index => $plan)
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
                                <button wire:click="selectForEdit({{ $plan->id }})"
                                    class="dropdown-item d-flex align-items-center">
                                    <span class="fas fa-user-shield me-2"></span>
                                    Edit
                                </button>
                                <button wire:click="delete({{ $plan->id }})"
                                    class="dropdown-item text-danger d-flex align-items-center">
                                    <span class="fas fa-user-times me-2"></span>
                                    Delete
                                </button>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="fw-normal">{{ $plan->name }}</span>
                    </td>
                    <td>
                        <span class="fw-normal">{{ $plan->duration_days }}</span>
                    </td>
                    <td><span class="fw-normal">Rp. {{ number_format($plan->price, 0, ',', '.') }}</span></td>

                </tr>                    
                @endforeach

            </tbody>
        </table>
    </div>
    </div>