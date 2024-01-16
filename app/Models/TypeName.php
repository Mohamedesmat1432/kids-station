<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeName extends Model
{
    use HasFactory;

    protected $table = 'type_names';

    protected $fillable = [
        'name',
        'status',
    ];

    public function Types(): HasMany
    {
        return $this->hasMany(Type::class);
    }

    protected function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
