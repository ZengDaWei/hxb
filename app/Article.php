<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Article extends Model
{
    public $fillable = [
        'title',
        'content',
        'description',
        'cover',
        'code',
        'status',
        'published_at',
    ];
    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

    public function getWords(): Int
    {
        if ($this->code == 0) {
            return mb_strwidth($this->content);
        }
        return 0;
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
