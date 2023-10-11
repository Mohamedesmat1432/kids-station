<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Orange extends Model
{
    use HasFactory;

    protected $table = 'oranges';

    protected $fillable = [
        'name',
        'price',
        'seats',
        'status',
        'start_date',
        'end_date',
        'company_id'
    ];

    public function Company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
