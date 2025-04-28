<?php

namespace App\Livewire;

use App\Models\Member;
use App\Models\MembershipPlan;
use App\Models\NonMember;
use App\Models\Payment;
use Carbon\Carbon;
use Livewire\Component;

class PaymentForm extends Component
{
    public $paymentId;
    public $member_id;
    public $non_member_id;
    public $membership_plan_id;
    public $amount;
    public $method;
    public $payment_date;

    public function mount($paymentId = null)
    {
        if ($paymentId) {
            $this->loadPayment($paymentId);
        } else {
            $this->payment_date = Carbon::now()->toDateString();
        }
    }

    public function loadPayment($id)
    {
        $payment = Payment::findOrFail($id);
        $this->paymentId = $id;
        $this->member_id = $payment->member_id;
        $this->non_member_id = $payment->non_member_id;
        $this->membership_plan_id = $payment->membership_plan_id;
        $this->amount = $payment->amount;
        $this->method = $payment->method;
        $this->payment_date = $payment->payment_date->format('Y-m-d');
    }

    public function save()
    {
        $this->validate([
            'membership_plan_id' => 'required|exists:membership_plans,id',
            'amount' => 'required|numeric|min:0',
            'method' => 'required|string',
            'payment_date' => 'required|date',
        ]);

        if (!$this->member_id && !$this->non_member_id) {
            $this->addError('member_id', 'Pilih salah satu: member atau non-member.');
            return;
        }

        Payment::updateOrCreate(
            ['id' => $this->paymentId],
            [
                'member_id' => $this->member_id,
                'non_member_id' => $this->non_member_id,
                'membership_plan_id' => $this->membership_plan_id,
                'amount' => $this->amount,
                'method' => $this->method,
                'payment_date' => $this->payment_date,
            ]
        );

        session()->flash('message', $this->paymentId ? 'Pembayaran diperbarui.' : 'Pembayaran ditambahkan.');
        return redirect()->to('/payment-form'); // sesuaikan dengan route kamu
    }

    public function render()
    {
        return view('livewire.payment-form', [
            'members' => Member::all(),
            'nonMembers' => NonMember::all(),
            'plans' => MembershipPlan::all(),
        ]);
    }
}
