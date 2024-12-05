<?php

namespace App\Traits;

use Livewire\Attributes\Url;

trait SortSearchTrait
{
    #[Url('')]
    public string $search = '';

    #[Url('')]
    public string $child_search = '';

    #[Url('')]
    public string $date = '';

    #[Url('')]
    public string $filter = '';

    #[Url('')]
    public string $sort_by = 'id';

    #[Url('')]
    public bool $sort_asc = false;

    #[Url('')]
    public int $page_element = 25;
    
    public bool $trash = false;
    public $status = false;
    public $checkbox_arr = [];
    public $checkbox_all = [];
    public $checkbox_status = false;

    public function toggleStatus()
    {
        $this->status = !$this->status;
    }

    public function checkboxAll()
    {
        $data = $this->checkbox_status ? $this->checkbox_all  : $this->checkbox_arr;

        if (count($this->checkbox_arr) < 1 || count($this->checkbox_arr) < count($data)) {
            $this->checkbox_arr = $data;
        } else {
            $this->checkbox_status = false;
            $this->checkbox_arr = [];
        }
    }

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

    public function updatingChildSearch()
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

    public function updatingUrl()
    {
        $this->resetPage();
    }
}
