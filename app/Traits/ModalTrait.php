<?php

namespace App\Traits;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;

trait ModalTrait
{
    public $create_modal = false;
    public $create_exists_modal = false;
    public $edit_modal = false;
    public $show_modal = false;
    public $attach_modal = false;
    public $restore_modal = false;
    public $delete_modal = false;
    public $force_delete_modal = false;
    public $bulk_delete_modal = false;
    public $force_bulk_delete_modal = false;
    public $import_modal = false;
    public $export_modal = false;
    public $note_modal = false;
    
    #[On('close-all-modal')]
    public function closeAllModal()
    {
        $this->reset('create_exists_modal');
    }
}
