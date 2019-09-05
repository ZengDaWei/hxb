<?php

Route::get('/', function () {
    $path = [
        'ffmpeg.binaries'  => '/usr/bin/ffmpeg',
        'ffprobe.binaries' => '/usr/bin/ffprobe',
    ];

    $ffmpeg = FFMpeg\FFMpeg::create($path);
    $video  = $ffmpeg->open('/home/aria/Downloads/66.mp4');
    $frame  = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(1)); //提取第几秒的图像
    $frame->save(storage_path('image.jpg'));
});

Route::post('/file', 'FileController@store');
