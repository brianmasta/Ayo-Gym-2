<div>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            window.print();
        });
    </script>

    <style>
        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            #print-area {
                width: 80mm;
                font-size: 12px;
            }

            .no-print {
                display: none !important;
            }

            table {
                width: 100%;
            }

            th, td {
                text-align: left;
                vertical-align: top;
                padding: 2px 0;
            }
        }

        #print-area {
            width: 80mm;
            margin: auto;
            font-family: monospace;
            background: white;
            padding: 10px;
            border: 1px dashed #ccc;
        }

        hr {
            border-top: 1px dashed #000;
            margin: 8px 0;
        }

        .title {
            text-align: center;
            font-weight: bold;
            font-size: 14px;
        }

        .thanks {
            text-align: center;
            font-size: 11px;
            margin-top: 10px;
        }

        .qr-wrapper {
            text-align: center;
            margin-top: 8px;
        }
    </style>

    <div class="container py-3">
        <div id="print-area">
            <div class="logo" style="text-align: center; margin-bottom: 6px;">
                <img src="{{ asset('assets/img/logo.png') }}" width="80" alt="Logo">
            </div>
            <div class="title">
                Bukti Pembayaran<br>Ayo Gym
            </div>
            <hr>
            <table>
                <tr>
                    <th>Nama</th>
                    <td>: {{ $payment->nonMember->name }}</td>
                </tr>
                <tr>
                    <th>Tujuan</th>
                    <td>: {{ $payment->nonMember->visit_purpose }}</td>
                </tr>
                <tr>
                    <th>Paket</th>
                    <td>: {{ $payment->membershipPlan->name }}</td>
                </tr>
                <tr>
                    <th>Harga</th>
                    <td>: Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Metode</th>
                    <td>: {{ ucfirst($payment->method) }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>: {{ ucfirst($payment->status) }}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>: {{ $payment->created_at->format('d M Y, H:i') }}</td>
                </tr>
            </table>
            <hr>
            <div class="qr-wrapper">
                {!! QrCode::size(80)->generate(url('/receipt/' . $payment->order_id)) !!}
                <div style="font-size: 10px;">Scan untuk cek bukti online</div>
            </div>
            <div class="thanks">
                Terima kasih telah berkunjung!<br>
                Semoga sehat selalu 💪
            </div>
        </div>

        <div class="text-center mt-3 no-print">
            <a href="{{ url('/receipt/' . $payment->order_id . '/pdf') }}" class="btn btn-outline-primary">Download PDF</a>
            <button onclick="window.print()" class="btn btn-outline-success">Cetak</button>
            <a href="
            @can('admin')
            /non-member
            @endcan
            @can('kasir')
            /kasir-dashboard
            @endcan
            " class="btn btn-outline-secondary">Kembali</a>
        </div>
    </div>
</div>