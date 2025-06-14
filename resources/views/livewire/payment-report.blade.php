<div>
    <div class="mb-4 flex flex-wrap items-center gap-2">
        <input type="text" wire:model.live="search" placeholder="Cari nama member..." class="p-2 border rounded">
        <input type="date" wire:model.live="startDate" class="p-2 border rounded">
        <input type="date" wire:model.live="endDate" class="p-2 border rounded">

        <button wire:click="clearFilters"
            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
            Clear Filter
        </button>
            <!-- Tombol Export Excel -->
    <button wire:click="exportExcel" class="btn btn-primary mb-3">Export Excel</button>
    </div>

    <div wire:loading class="text-blue-500 mb-2">Memuat data...</div>

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Nama Member</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Jumlah</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Tanggal Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($payments as $payment)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $payment->member->name }}</td>
                    <td class="px-4 py-2">{{ $payment->member->email }}</td>
                    <td class="px-4 py-2">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded
                            @if($payment->status === 'paid') bg-green-200
                            @elseif($payment->status === 'pending') bg-yellow-200
                            @else bg-red-200 @endif">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-2 text-center">Tidak ada data pembayaran.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $payments->links() }}
    </div>
</div>