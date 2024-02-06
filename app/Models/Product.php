<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['name', 'description', 'price', 'purchase_price', 'revenue_price', 'qty', 'unit_id', 'category_id'];

    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function Unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }
}
