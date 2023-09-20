<?php

namespace App\Traits;

use Livewire\Attributes\Url;

trait SortSearchTrait
{
    #[Url()]
    public $search;

    #[Url()]
    public $sort_by = 'id';

    #[Url()]
    public $sort_asc = true;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortByField($field)
    {
        if ($field == $this->sort_by) {
            $this->sort_asc = !$this->sort_asc;
        }
        $this->sort_by = $field;
    }
}
