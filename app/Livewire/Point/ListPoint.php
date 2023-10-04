<?php

namespace App\Livewire\Point;

use App\Exports\PointExport;
use App\Imports\PointImport;
use App\Models\Point;
use App\Traits\PointTrait;
use App\Traits\SortSearchTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListPoint extends Component
{
    use WithPagination,SortSearchTrait;

    public $checkbox_arr = [];

    public function checkboxAll()
    {
        if (empty($this->checkbox_arr)) {
            $this->checkbox_arr = Point::pluck('id')->toArray();
        } else {
            $this->checkbox_arr = [];
        }
    }

    #[On('bulk-delete-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
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
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.point.list-point', [
            'points' => $points
        ]);
    }

}
