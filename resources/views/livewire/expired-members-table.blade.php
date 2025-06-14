<div>
    <div class="card overflow-x-auto">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="fs-5 fw-bold mb-0">Daftar Member Expired</h2>
                </div>
            </div>

        </div>

        <div class="table-responsive">
            @if ($expiredMembers->count())
            <table class="table align-items-center table-flush">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="px-4 py-2 border-b">No</th>
                        <th class="px-4 py-2 border-b">ID Member</th>
                        <th class="px-4 py-2 border-b">Nama</th>
                        <th class="px-4 py-2 border-b">Phone</th>
                        <th class="px-4 py-2 border-b">Email</th>
                        <th class="px-4 py-2 border-b">Tanggal Expired</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expiredMembers as $index => $member)
                        <tr>
                            <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border-b">{{ $member->member_code }}</td>
                            <td class="px-4 py-2 border-b">{{ $member->name }}</td>
                            <td class="px-4 py-2 border-b">{{ $member->phone }}</td>
                            <td class="px-4 py-2 border-b">{{ $member->email }}</td>
                            <td class="px-4 py-2 border-b text-red-600">{{ $member->end_date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="text-gray-500">Tidak ada member yang expired.</div>
        @endif
        </div>
    </div>
</div>
