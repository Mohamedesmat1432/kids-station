<?php

namespace App\Livewire\License;

use App\Models\License;
use Livewire\Component;
use App\Traits\SortSearchTrait;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class ListLicense extends Component
{
    use WithPagination, SortSearchTrait;

    #[On('create-license')]
    #[On('update-license')]
    #[On('delete-license')]
    #[On('import-license')]
    public function render()
    {
        $this->authorize('view-license');

        $licenses = License::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('file', 'like', '%' . $this->search . '%')
                    ->orWhere('start_date', 'like', '%' . $this->search . '%')
                    ->orWhere('end_date', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate($this->page_element);

        return view('livewire.license.list-license', [
            'licenses' => $licenses,
        ]);
    }
}
