<?php

namespace App;

use App\Traits\JsonUtil;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Video extends Model
{

    use JsonUtil;

    protected $fillable = [
        'user_id',
        'json',
        'description',
        'path',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function setVideoInfo($cover, $width, $height)
    {
        $this->setJsonData('cover', $cover);
        $this->setJsonData('width', $width);
        $this->setJsonData('height', $height);
    }
}
