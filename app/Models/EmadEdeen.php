<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmadEdeen extends Model
{
    use HasFactory;

    protected $table = 'emad_edeens';

    protected $fillable = [
        'name',
        'email',
        'department_id',
        'device_id',
        'ip_id',
        'switch_id',
        'patch_id',
    ];

    public function Department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function Device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }

    public function Ip(): BelongsTo
    {
        return $this->belongsTo(Ip::class);
    }

    public function Switch(): BelongsTo
    {
        return $this->belongsTo(SwitchBranch::class);
    }

    public function Patch(): BelongsTo
    {
        return $this->belongsTo(PatchBranch::class);
    }
}
