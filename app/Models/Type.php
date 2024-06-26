<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'types';

    protected $fillable = ['type_name_id', 'price', 'duration', 'status'];

    public function typeName(): BelongsTo
    {
        return $this->belongsTo(TypeName::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'visitors');
    }

    protected function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($query) use ($search) {
            $query->where('price', 'like', "%{$search}%");
        });
    }
}
