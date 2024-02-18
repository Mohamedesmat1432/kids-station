<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MoneySafeProduct extends Model
{
    use HasFactory;

    protected $table = 'money_safe_products';

    protected $fillable = ['user_id', 'date_now', 'total_order', 'total_daily_expense', 'total'];

    protected $casts = [
        'created_at' => 'datetime: H:i',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
