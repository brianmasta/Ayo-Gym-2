<?php

namespace App\Livewire;

use App\Models\Payment;
use Livewire\Component;

class Receipt extends Component
{
    public $payment;

    public function mount($orderId)
    {

        $this->payment = Payment::where('non_member_id', $orderId)->with('nonMember', 'membershipPlan')->firstOrFail();
    }

    public function render()
    {
        return view('livewire.receipt');
    }
}
