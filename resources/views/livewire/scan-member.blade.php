<div>
    <audio id="beep-sound" src="/assets/sounds/scanner.mp3" preload="auto"></audio>
    <title>Ayo Gym Dashboard - Scan Member</title>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="/dashboard">
                            <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Member</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Scan Member</li>
                </ol>
            </nav>
            <h2 class="h4">Scan Member</h2>
            <p class="mb-0 text-muted">Gunakan kamera untuk mengecek status keanggotaan member.</p>
        </div>
    </div>

    <div class="card border-0 shadow mb-4">
        <div class="card-body text-center">
            <h5 class="mb-3">Arahkan QR Code ke kamera</h5>

            <div id="reader" style="max-width: 300px; margin: 0 auto;" class="border rounded-3 p-2"></div>

            <input type="hidden" wire:model.live="scannedId" id="scanned-id">

            {{-- <button class="btn btn-outline-primary btn-sm mt-3" wire:click="scanUlang">🔄 Scan Ulang</button> --}}
            <a class="btn btn-danger btn-sm mt-3" href="/scan-member">Scan Ulang</a>
            
        </div>

    </div>

    @if($member)
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Nama: {{ $member->name }}</h5>
            <p class="card-text">ID Member: <strong>{{ $member->member_code }}</strong></p>
            <p class="card-text">
                Status:
                @if ($member->status == 'active')
                    <span class="badge bg-success">Aktif</span>
                @else
                    <span class="badge bg-danger">Tidak Aktif</span>
                @endif
            </p>
            <p class="card-text">Tanggal Mulai: <strong>{{ $member->start_date }}</strong></p>
            <p class="card-text">Tanggal Selesai: <strong>{{ $member->end_date }}</strong></p>
            <p class="card-text">
                Sisa Hari:
                @if ($this->sisaHari < 0)
                    <span class="badge bg-danger">Expired {{ abs($this->sisaHari) }} hari lalu</span>
                @else
                    <span class="badge bg-success">{{ $this->sisaHari }} hari lagi</span>
                @endif
            </p>
        </div>
    </div>
    @elseif($scannedId)
    <div class="alert alert-danger mt-3 text-center">❌ Member tidak ditemukan</div>
    @endif
</div>

<!-- QR Code Scanner -->

<script>
    const html5QrCode = new Html5Qrcode("reader");

    function onScanSuccess(decodedText, decodedResult) {
        const id = decodedText.trim();

        const beep = document.getElementById('beep-sound');
        beep.currentTime = 0;
        beep.play();

        document.getElementById('scanned-id').value = id;
        document.getElementById('scanned-id').dispatchEvent(new Event('input'));

        stopScanner();
    }

    function startScanner() {
        html5QrCode.start(
            { facingMode: "environment" },
            { fps: 10, qrbox: 250 },
            onScanSuccess
        ).catch(err => {
            console.error("Camera start error", err);
        });
    }

    function stopScanner() {
        html5QrCode.stop().then(() => {
            console.log("Scanner stopped");
        }).catch(err => {
            console.error("Scanner stop error", err);
        });
    }

    startScanner();

    // Hidupkan ulang kamera jika Livewire reset
    window.addEventListener('scan-again', () => {
        startScanner();
    });
</script>