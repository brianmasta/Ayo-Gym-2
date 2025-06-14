<?php

namespace App\Livewire;

use App\Models\Payment;
use Livewire\Component;

class ReceiptMember extends Component
{
    public $payment;

    public function mount($orderId)
    {

        $this->payment = Payment::where('order_id', $orderId)->with('member', 'membershipPlan')->firstOrFail();
    }

    public function render()
    {
        return view('livewire.receipt-member');
    }
}
