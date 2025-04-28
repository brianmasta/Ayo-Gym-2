<div>
    @php
    use SimpleSoftwareIO\QrCode\Facades\QrCode;
    @endphp
    <div id="kartu-member" class="card shadow mx-auto mt-5" style="width: 450px; height: 250px; border-radius: 16px; overflow: hidden; font-family: 'Arial', sans-serif;">
    <div id="print-area" class="d-flex" style="height: 100%;">
        {{-- Kiri: Info --}}
        <div class="p-4" style="width: 65%; background: linear-gradient(135deg, #ea962f, #dc5a14); color: white;">
            {{-- Logo --}}
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Gym" style="position: absolute; top: 10px; right: 10px; width: 50px; height: auto;">
            
            <h5 style="margin-bottom: 0;">KARTU MEMBER</h5>
            <p style="font-size: 12px;">AYO GYM</p>

            

            <hr style="border-color: rgba(255,255,255,0.3);">

            <p style="margin-bottom: 4px;"><strong>ID:</strong> {{ $member['member_code'] }}</p>
            <p style="margin-bottom: 4px;"><strong>Nama:</strong> {{ $member['name'] }}</p>
            <p style="margin-bottom: 4px;"><strong>Telp:</strong> {{ $member['phone'] }}</p>
            <p style="margin-bottom: 4px;"><strong>Berlaku:</strong><br>{{ $member['join_date'] }} s/d {{ $member['end_date'] }}</p>
        </div>

        {{-- Kanan: QR Code --}}
        <div class="p-3 d-flex align-items-center justify-content-center" style="width: 35%; background-color: #E8F5E9;">
            {!! QrCode::size(100)->generate($member['member_code']) !!}
        </div>
    </div>
</div>

<div class="text-center mt-3">
    <button class="btn btn-primary" onclick="printCard()">Cetak Kartu</button>
    <a href="{{ route('member') }}" class="btn btn-secondary" wire:navigate>Kembali</a>
</div>
<script>
    function printCard() {
        const printContents = document.getElementById('kartu-member').outerHTML;
        const originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }
</script>
<br>
<br>
<br>
</div>
