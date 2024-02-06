<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = ['number', 'user_id', 'customer_name', 'customer_phone', 'duration', 'offer_id', 'visitors', 'total', 'remianing', 'last_number', 'last_total', 'start_date', 'end_date', 'status'];

    protected function visitors(): Attribute
    {
        return Attribute::make(get: fn($value) => json_decode($value, true), set: fn($value) => json_encode($value));
    }

    protected $casts = [
        'start_date' => 'datetime: H:i',
        'end_date' => 'datetime: H:i',
        // 'visitors' => 'array'
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function Offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }

    public function Type(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'visitors["type_id"]');
    }
}
