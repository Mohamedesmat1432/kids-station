<?php

namespace App\Traits;

trait WithNotify
{
    public function successNotify($message, $style = 'success')
    {
        $this->dispatch('notify', style: $style, message: $message);
    }

    public function errorNotify($message, $style = 'danger')
    {
        $this->dispatch('notify',  style: $style, message: $message);
    }
}
