<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductOrder extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'product_orders';

    protected $fillable = ['number', 'user_id', 'products', 'total', 'status'];

    protected $casts = [
        'products' => 'array'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('total', 'like', '%' . $search . '%')
                ->orWhere('products', 'like', '%' . $search . '%');
        });
    }
}
