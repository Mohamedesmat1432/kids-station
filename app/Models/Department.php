<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';

    protected $fillable = ['name'];

    public function Edokis(): HasMany
    {
        return $this->hasMany(Edoki::class, 'department_id');
    }

    public function EmadEdeens(): HasMany
    {
        return $this->hasMany(EmadEdeen::class, 'department_id');
    }
}
