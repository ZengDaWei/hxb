<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    public $fillable = [
        'content',
        'user_id',
        'commentable_id',
        'commentable_type',
    ];
    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }
}
