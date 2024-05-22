<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'offers';

    protected $fillable = ['name', 'price', 'status'];

    protected function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('price', 'like', "%{$search}%");
        });
    }
}
