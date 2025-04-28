<?php

namespace App\Livewire;

use App\Models\Member;
use App\Models\MembershipPlan;
use App\Models\Payment;
use Livewire\Component;

class ExtendMembership extends Component
{

    public function render()
    {
        return view('livewire.extend-membership');
    }
}
