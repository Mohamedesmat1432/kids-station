<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyExpenseProduct extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id', 'data', 'total'];

    protected function data(): Attribute
    {
        return Attribute::make(get: fn($value) => json_decode($value, true), set: fn($value) => json_encode($value));
    }
    
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
