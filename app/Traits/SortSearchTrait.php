<?php

namespace App\Traits;

trait SortSearchTrait
{
    public $search;
    public $sort_by = 'id';
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