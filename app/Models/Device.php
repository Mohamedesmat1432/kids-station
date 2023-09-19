<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Device extends Model
{
    use HasFactory;

    protected $table = 'devices';

    protected $fillable = [
        'name',
        'serial',
        'specifications',
    ];

    public function Edokis(): HasMany
    {
        return $this->hasMany(Edoki::class, 'device_id');
    }

    public function EmadEdeens(): HasMany
    {
        return $this->hasMany(EmadEdeen::class, 'device_id');
    }
}
