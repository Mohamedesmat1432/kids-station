<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('livewire:init {name}', function (string $name) {
    Artisan::call("make:model {$name} -m");
    Artisan::call("make:seeder {$name}Seeder");
    Artisan::call("make:livewire {$name}.List{$name}");
    Artisan::call("make:livewire {$name}.Create{$name}");
    Artisan::call("make:livewire {$name}.Update{$name}");
    Artisan::call("make:livewire {$name}.Show{$name}");
    Artisan::call("make:livewire {$name}.Delete{$name}");
    Artisan::call("make:livewire {$name}.BulkDelete{$name}");
    Artisan::call("make:livewire {$name}.ImportExport{$name}");
    Artisan::call("make:import {$name}sImport --model={$name}");
    Artisan::call("make:export {$name}sExport --model={$name}");
    Artisan::call("make:livewire {$name}.Restore{$name}");
    Artisan::call("make:livewire {$name}.ForceDelete{$name}");
    Artisan::call("make:livewire {$name}.ForceBulkDelete{$name}");
})->describe('Running commands');
