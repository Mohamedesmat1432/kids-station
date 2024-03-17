<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'orders';

    protected $fillable = ['number', 'user_id', 'customer_name', 'customer_phone', 'duration', 'offer_id', 'visitors', 'total', 'remianing', 'last_number', 'last_total', 'start_date', 'end_date', 'status'];

    protected $casts = [
        'start_date' => 'datetime: H:i',
        'end_date' => 'datetime: H:i',
        'visitors' => 'array'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'visitors');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('number', 'like', '%' . $search . '%')
            ->orWhere('customer_name', 'like', '%' . $search . '%')
            ->orWhere('customer_phone', 'like', '%' . $search . '%')
            ->orWhere('visitors', 'like', '%' . $search . '%')
            ->orWhere('total', 'like', '%' . $search . '%');
        });
    }
}
