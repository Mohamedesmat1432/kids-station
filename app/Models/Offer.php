<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'offers';
    
    protected $fillable = [
        'name',
        'price',
        'status'
    ];

    protected function scopeActive($query)
    {
        return $query->where('status', true);
    }


    public function Orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
