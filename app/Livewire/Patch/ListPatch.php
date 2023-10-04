<?php

namespace App\Livewire\Patch;

use App\Models\PatchBranch;
use App\Traits\SortSearchTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListPatch extends Component
{
    use WithPagination, SortSearchTrait;

    public $checkbox_arr = [];

    public function checkboxAll()
    {
        if (empty($this->checkbox_arr)) {
            $this->checkbox_arr = PatchBranch::pluck('id')->toArray();
        } else {
            $this->checkbox_arr = [];
        }
    }

    #[On('bulk-delete-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
    }

    #[On('create-patch')]
    #[On('update-patch')]
    #[On('delete-patch')]
    #[On('bulk-delete-patch')]
    public function render()
    {
        $this->authorize('view-patch');

        $patchs = PatchBranch::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('port', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.patch.list-patch', [
            'patchs' => $patchs
        ]);
    }
}
