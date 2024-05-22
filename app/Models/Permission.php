<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as ModelsPermission;

class Permission extends ModelsPermission
{
    public $guard_name = 'web';

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%");
        });
    }
}
