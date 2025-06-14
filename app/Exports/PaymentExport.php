<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PaymentExport implements FromCollection, WithHeadings
{
    protected $payments;

    // Menerima data pembayaran sebagai parameter
    public function __construct($payments)
    {
        $this->payments = $payments;
    }

    // Mengembalikan koleksi pembayaran
    public function collection()
    {
        return $this->payments->map(function($payment) {
            return [
                $payment->member_code,
                $payment->member->name, // Pastikan relasi sudah benar
                $payment->amount,
                $payment->method,
                $payment->payment_date, // Format tanggal sesuai keinginan
                $payment->status,
            ];
        });
    }

    // Menambahkan heading pada Excel
    public function headings(): array
    {
        return [
            'ID member',
            'Nama Member',
            'Jumlah Pembayaran',
            'Metode Pembayaran',
            'Tanggal Pembayaran',
            'Status',
        ];
    }
}
