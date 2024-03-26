<?php

namespace App\Traits;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;

trait ModalTrait
{
    #[Locked]
    public $modal_id, $modal_name;

    public $create_modal = false;
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
}
