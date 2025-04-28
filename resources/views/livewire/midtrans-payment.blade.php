<div>
    <div>
        <div class="container py-5">
            <h2>Konfirmasi Pembayaran</h2>
            <ul>
                <li><strong>Nama:</strong> {{ $memberData['name'] }}</li>
                <li><strong>Email:</strong> {{ $memberData['email'] }}</li>
                <li><strong>No HP:</strong> {{ $memberData['phone'] }}</li>
                <li><strong>Paket:</strong> {{ $memberData['membership_plan_id'] }}</li>
                <li><strong>Total:</strong> Rp {{ number_format($memberData['amount'], 0, ',', '.') }}</li>
            </ul>
        
            <button id="pay-button" wire:click="pay" class="btn btn-primary mt-3">Bayar Sekarang</button>
        </div>
    
        <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('midtrans.client_key') }}"></script>
    
            <script>
                window.addEventListener('snap-token-generated', event => {
                    const token = event.detail.snapToken;
            
                    snap.pay(token, {
                        onSuccess: function (result) {
                            console.log('Success:', result);
                        },
                        onPending: function (result) {
                            console.log('Pending:', result);
                        },
                        onError: function (result) {
                            console.log('Error:', result);
                        },
                        onClose: function () {
                            alert('Kamu menutup popup tanpa menyelesaikan pembayaran');
                        }
                    });
                });
            </script>
    </div>
</div>
