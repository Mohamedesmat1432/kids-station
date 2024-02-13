<?php

namespace App\Traits;

trait ModalTrait
{
    public $create_modal = false;
    public $edit_modal = false;
    public $delete_modal = false;
    public $restore_modal = false;
    public $force_delete_modal = false;
    public $bulk_delete_modal = false;
    public $force_bulk_delete_modal = false;
    public $import_modal = false;
    public $export_modal = false;
    public $trashed = false;
    public function trashedActive(){
        $this->trashed = true;
        $this->reset(['checkbox_arr']);
    }
    public function trashedNonActive(){
        $this->trashed = false;
        $this->reset(['checkbox_arr']);
    }

}
