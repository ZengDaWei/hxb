<?php

namespace App;

use App\Traits\JsonUtil;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{

    use JsonUtil;

    protected $fillable = [
        'user_id',
        'json',
        'path',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function setImageInfo($path)
    {
        if ($image = getimagesize($path)) {
            $width  = $image["0"];
            $height = $image["1"];
            $hash   = md5_file($path);
            $this->setJsonData('width', $width);
            $this->setJsonData('height', $height);
            $this->setJsonData('hash', $hash);
        }

    }
}
