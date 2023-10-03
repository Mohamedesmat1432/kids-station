<?php

namespace App\Traits;

trait ConfirmTrait
{
    public $confirm_delete = false;
    public $confirm_form = false;
    public $confirm_show = false;
    public $confirm_import = false;

    public $modal_create = false;
    public $modal_edit = false;
    public $modal_delete = false;
}