<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'email',
        'address',
        'contacts',
        'specialization',
    ];

    public function Licenses(): HasMany
    {
        return $this->hasMany(License::class);
    }
    
    // public function getPhoneNumberAttribute()
    // {
    //     return rtrim(chunk_split($this->phone, 3, '-'), '-');
    // }
}
