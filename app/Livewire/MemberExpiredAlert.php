<?php

namespace App\Livewire;

use App\Models\Member;
use Livewire\Component;

class MemberExpiredAlert extends Component
{
    public $expiredCount = 0;

    public function mount()
    {
        $this->expiredCount = Member::expired()->count();
    }

    public function render()
    {
        return view('livewire.member-expired-alert');
    }
}
