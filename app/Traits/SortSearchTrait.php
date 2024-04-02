<?php

namespace App\Traits;

use Livewire\Attributes\Url;

trait SortSearchTrait
{
    #[Url('')]
    public string $search = '';

    #[Url('')]
    public string $date = '';

    #[Url('')]
    public string $filter = '';

    #[Url('')]
    public string $sort_by = 'id';

    #[Url('')]
    public bool $sort_asc = false;

    #[Url('')]
    public int $page_element = 10;
    
    public bool $trash = false;

    public function sortByField($field)
    {
        if ($field == $this->sort_by) {
            $this->sort_asc = !$this->sort_asc;
        }
        $this->sort_by = $field;
    }

    public function updatingPageElement()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingDate()
    {
        $this->resetPage();
    }

    public function updatingTrash()
    {
        $this->resetPage();
        $this->reset();  
    }

    public function updatingFilter()
    {
        $this->resetPage();
    }
}
