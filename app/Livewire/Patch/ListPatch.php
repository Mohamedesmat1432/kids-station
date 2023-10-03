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

    #[On('create-patch')]
    #[On('update-patch')]
    #[On('delete-patch')]
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
