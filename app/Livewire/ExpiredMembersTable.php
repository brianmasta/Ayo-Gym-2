<?php

namespace App\Livewire;

use App\Models\Member;
use Livewire\Component;

class ExpiredMembersTable extends Component
{
    public $expiredMembers = [];

    public function mount()
    {
        $this->expiredMembers = Member::expired()->get();
    }

    public function render()
    {
        return view('livewire.expired-members-table');
    }
}
