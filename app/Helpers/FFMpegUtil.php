<?php

namespace App\Helpers;

use FFMpeg\Coordinate\TimeCode;
use Illuminate\Support\Str;

class FFMpegUtil
{

    // 获取视频信息
    public static function getVideoInfo($streamPath)
    {
        $ffprobe = app('ffprobe');
        $stream  = $ffprobe->streams($streamPath)->videos()->first();
        return $stream ? $stream->all() : [];
    }

    // 截取
    public static function getCover($streamPath, $fromSecond)
    {
        $ffmpeg   = app('ffmpeg');
        $video    = $ffmpeg->open($streamPath);
        $frame    = $video->frame(TimeCode::fromSeconds($fromSecond)); //提取第几秒的图像
        $fileName = 'video/' . Str::random(12) . '.jpg';
        if (!is_dir(storage_path("video"))) {
            mkdir(storage_path("video"), 0777);
        }
        $frame->save(storage_path($fileName));

        return $fileName;
    }
}
