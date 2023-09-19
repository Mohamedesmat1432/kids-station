<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ip extends Model
{
    use HasFactory;

    protected $table = 'ips';

    protected $fillable = ['number'];

    public function Edokis(): HasMany
    {
        return $this->hasMany(Edoki::class, 'ip_id');
    }

    public function EmadEdeens(): HasMany
    {
        return $this->hasMany(EmadEdeen::class, 'ip_id');
    }
}
