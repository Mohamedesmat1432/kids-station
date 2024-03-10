<?php

namespace App\Traits;

use Livewire\Attributes\Url;

trait SortSearchTrait
{
    #[Url('')]
    public $search = '';

    #[Url('')]
    public $filter = '';

    #[Url('')]
    public $sort_by = 'id';

    #[Url('')]
    public $sort_asc = false;

    #[Url('')]
    public $page_element = 10;
    
    #[Url('')]
    public $trash = false;

    public function updatingPageElement()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingTrash()
    {
        $this->resetPage();
    }

    public function updatingFilter()
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
