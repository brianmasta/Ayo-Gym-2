<?php

namespace App\Livewire;

use App\Models\Payment;
use Livewire\Component;
use Livewire\WithPagination;
use App\Exports\PaymentExport;
use Maatwebsite\Excel\Facades\Excel;

class PaymentReport extends Component
{
    use WithPagination;

    public string $search = '';
    public ?string $startDate = null;
    public ?string $endDate = null;

    public function render()
    {
        $query = Payment::with('member')
            ->whereHas('member', fn ($q) =>
                $q->where('name', 'like', "%{$this->search}%")
            );

        if ($this->startDate) {
            $query->whereDate('payment_date', '>=', $this->startDate);
        }

        if ($this->endDate) {
            $query->whereDate('payment_date', '<=', $this->endDate);
        }

        $payments = $query->orderBy('payment_date', 'desc')->paginate(10);

        return view('livewire.payment-report', [
            'payments' => $payments,
        ]);
    }

    public function clearFilters()
    {
        $this->reset(['search', 'startDate', 'endDate']);
    }

    public function exportExcel()
    {
        $query = Payment::with('member')
            ->whereHas('member', fn ($q) =>
                $q->where('name', 'like', "%{$this->search}%")
            );

        if ($this->startDate) {
            $query->whereDate('payment_date', '>=', $this->startDate);
        }

        if ($this->endDate) {
            $query->whereDate('payment_date', '<=', $this->endDate);
        }

        $payments = $query->get(); // Ambil data pembayaran tanpa paginasi

        return Excel::download(new PaymentExport($payments), 'payment-report.xlsx');
    }
}
