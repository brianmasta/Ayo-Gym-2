<?php

namespace App\Livewire;

use App\Models\Member as ModelsMember;
use Livewire\Component;
use Livewire\WithPagination;

class Member extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $perPage = 10; // Jumlah item per halaman
    
    public $search = '';

    public $sortBy = 'name'; // kolom default yang di-sort
    public $sortDirection = 'asc'; // urutan sorting default

    public $editId;

    public $name, $phone, $birthdate, $gender, $join_date, $address, $email, $memberCode, $membership_plan_id, $status, $start_date, $end_date;

    // Metode untuk mengubah urutan
    public function sort($column)
    {
        if ($this->sortBy === $column) {
            // Jika sudah disort berdasarkan kolom yang sama, toggle urutan
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            // Jika kolom berbeda, atur ke urutan default (asc)
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $members = ModelsMember::query()
        ->when($this->search, function ($query) {
            $query->where(function($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        })
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);
        
        return view('livewire.member', compact('members'));
    }

    public function delete($id)
    {
        $member = ModelsMember::findOrFail($id);
        $member->delete();

        session()->flash('message', 'Member berhasil dihapus.');
        return redirect()->to('/member');
    }

    public function edit($id)
    {
        $member = ModelsMember::findOrFail($id);
        $this->editId = $member->id;
        $this->name = $member->name;
        $this->email = $member->email;
        $this->phone = $member->phone;
        $this->birthdate = $member->birthdate;
        $this->gender = $member->gender;
        $this->address = $member->address;
        $this->memberCode = $member->member_code;
        $this->membership_plan_id = $member->membership_plan_id;
        $this->join_date = $member->join_date;
        $this->status = $member->status;
        $this->start_date = $member->start_date;
        $this->end_date = $member->end_date;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone'=> 'required',
            'birthdate'=> 'required|date',
            'gender'=> 'required|in:L,P',
            'address'=> 'required',
            'membership_plan_id'=> 'required',
            'join_date'=> 'required',
            'status'=> 'required',
            'start_date'=> 'required|date',
            'end_date'=> 'required|date',
        ]);

        $member = ModelsMember::findOrFail($this->editId);
        $member->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone'=> $this->phone,
            'birthdate'=> $this->birthdate,
            'gender'=> $this->gender,
            'address'=> $this->address,
            'membership_plan_id'=> $this->membership_plan_id,
            'join_date'=> $this->join_date,
            'status'=> $this->status,
            'start_date'=> $this->start_date,
            'end_date'=> $this->end_date,
        ]);

        session()->flash('message', 'Data member berhasil diperbarui.');
        $this->reset(['editId', 'name', 'email', 'phone', 'birthdate', 'gender', 'address', 'membership_plan_id', 'join_date', 'status', 'start_date','end_date']);
    }


}
