<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Point extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function Edokis(): HasMany
    {
        return $this->hasMany(Edoki::class, 'point_id');
    }

    public function EmadEdeens(): HasMany
    {
        return $this->hasMany(EmadEdeen::class, 'point_id');
    }
}
