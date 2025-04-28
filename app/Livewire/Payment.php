<?php

namespace App\Livewire;

use App\Models\MembershipPlan;
use App\Models\Payment as ModelsPayment;
use Livewire\Component;
use Livewire\WithPagination;

class Payment extends Component
{

    use WithPagination;

    public $perPage = 10;

    public $search = '';
    public $filterMembershipPlan = '';

    public $editId, $member_id, $membership_plan_id, $amount, $method, $payment_date, $status, $no_member_id, $member_code;

    public $membershipplan = [];

    protected $paginationTheme = "bootstrap";

    public function edit($id)
    {
        $payment = ModelsPayment::findOrFail($id);
        $this->editId = $payment->id;
        $this->member_id = $payment->member_id;
        $this->membership_plan_id = $payment->membership_plan_id;
        $this->amount = $payment->amount;
        $this->method = $payment->method;
        $this->payment_date = $payment->payment_date;
        $this->status = $payment->status;
        $this->no_member_id = $payment->no_member_id;
        $this->member_code = $payment->member_code;

        $this->membershipplan = MembershipPlan::all();
        // dd(vars: $this->membershipplan);
    }

    public function render()
    {
        $payments = ModelsPayment::with(['member', 'nonMember', 'membershipplan'])
        ->when($this->search, function ($query) {
            $query->whereHas('member', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })->orWhereHas('nonMember', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            });
        })->when($this->filterMembershipPlan, function ($query) {
            $query->where('membership_plan_id', $this->filterMembershipPlan);
        })->latest()->paginate($this->perPage);

        return view('livewire.payment', [
            'payment' => $payments,
            'membershipPlans' => \App\Models\MembershipPlan::all(),
        ]);
    }
}
