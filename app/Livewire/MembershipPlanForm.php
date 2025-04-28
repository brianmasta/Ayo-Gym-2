<?php

namespace App\Livewire;

use App\Models\MembershipPlan;
use Livewire\Component;

class MembershipPlanForm extends Component
{
    public $planId;
    public $name;
    public $duration_days;
    public $price;

    public function mount($planId = null)
    {
        if ($planId) {
            $plan = MembershipPlan::find($planId);
            $this->planId = $plan->id;
            $this->name = $plan->name;
            $this->duration_days = $plan->duration_days;
            $this->price = $plan->price;
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'duration_days' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        MembershipPlan::updateOrCreate(
            ['id' => $this->planId],
            ['name' => $this->name, 'duration_days' => $this->duration_days, 'price' => $this->price]
        );

        $this->reset(['name', 'duration_days', 'price', 'planId']);
        session()->flash('message', 'Paket berhasil disimpan.');
        // $this->dispatch('refreshComponent');
        return $this->redirect('/membership-plan');
    }

    public function render()
    {
        return view('livewire.membership-plan-form');
    }
}
