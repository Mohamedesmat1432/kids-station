<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'message', 'reciever_id', 'group_chat'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
