<?php

namespace App\Traits;

trait MessageTrait
{
    public function successMessage($message)
    {
        $this->dispatch('banner-message', message: $message, style: 'success');
    }

    public function errorMessage($message)
    {
        $this->dispatch('banner-message', message: $message, style: 'danger');
    }
}
