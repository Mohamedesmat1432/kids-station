<?php

namespace App\Livewire\Point;

use App\Exports\PointExport;
use App\Imports\PointImport;
use App\Livewire\Forms\PointForm;
use App\Models\Point;
use App\Traits\PointTrait;
use App\Traits\SortSearchTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListPoint extends Component
{
    use WithPagination,SortSearchTrait;

    public PointForm $form;

    public function checkboxAll()
    {
       $this->form->checkboxAll();
    }

    #[On('bulk-delete-clear')]
    public function checkboxClear()
    {
        $this->form->checkbox_arr = [];
    }

    #[On('create-point')]
    #[On('update-point')]
    #[On('delete-point')]
    #[On('bulk-delete-point')]
    public function render()
    {
        $this->authorize('view-point');

        $points = Point::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate($this->page_element);

        return view('livewire.point.list-point', [
            'points' => $points
        ]);
    }

}
