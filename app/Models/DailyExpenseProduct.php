<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyExpenseProduct extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id', 'data', 'total'];

    protected $casts = [
        'data' => 'array'
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('total', 'like', '%' . $search . '%');
        });
    }

    public function scopeSearchDate($query, $date)
    {
        return $query->where(function ($query) use ($date) {
            $query->where('created_at', 'like', '%' . $date . '%');
        });
    }
}
