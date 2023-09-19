<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SwitchBranch extends Model
{
    use HasFactory;

    protected $table = 'switch_branchs';

    protected $fillable = ['port'];

    public function Edokis(): HasMany
    {
        return $this->hasMany(Edoki::class, 'switch_id');
    }

    public function EmadEdeens(): HasMany
    {
        return $this->hasMany(EmadEdeen::class, 'switch_id');
    }
}
