<?php

namespace App\Livewire;

use App\Models\NonMember as ModelsNonMember;
use Livewire\Component;
use Livewire\WithPagination;

class NonMember extends Component
{
    use WithPagination;
    
    protected $paginationTheme = "bootstrap";
    public $nonmember, $editId, $name, $phone, $visit_purpose;
    public $perPage = 10;
    public $search = '';
    public $sortBy = 'name'; // kolom default yang di-sort
    public $sortDirection = 'asc'; // urutan sorting default

    public function mount()
    {
        $this->nonmember = ModelsNonMember::all();
    }

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

    public function render()
    {
        $nonMember = ModelsNonMember::query()
        ->where('name', 'like', '%' . $this->search . '%')
        ->orWhere('phone', 'like', '%' . $this->search . '%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.non-member', compact('nonMember'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public $editNonMember = [
        'id' => null,
        'name' => '',
        'phone' => '',
        'visit_purpose' => '',
    ];

    // Tampilkan data ke form edit
    public function edit($id)
    {
        $nonMember = ModelsNonMember::findOrFail($id);
        $this->editId = $nonMember->id;
        $this->name = $nonMember->name;
        $this->phone = $nonMember->phone;
        $this->visit_purpose = $nonMember->visit_purpose;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'phone' => 'required',
            'visit_purpose'=> 'required',
        ]);

        $nonmember = ModelsNonMember::findOrFail($this->editId);
        $nonmember->update([
            'name' => $this->name,
            'phone'=> $this->phone,
            'visit_purpose'=> $this->visit_purpose,
        ]);

        session()->flash('message', 'Data member berhasil diperbarui.');
        $this->reset(['editId', 'name', 'phone', 'visit_purpose']);
        return redirect()->to('/non-member');
    }

    public function delete($id)
    {
        $nonmember = ModelsNonMember::findOrFail($id);
        $nonmember->delete();

        session()->flash('message', 'Member berhasil dihapus.');
        return redirect()->to('/non-member');
    }
}
