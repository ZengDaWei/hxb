<?php

function getUser()
{
    if (Auth::check()) {
        return Auth::user();
    }

    if (auth('api')->user()) {
        return auth('api')->user();
    }

    $user = session('user');
    if (!$user) {
        if ($user = request()->user()) {
            return $user;
        }
        if ($token = request()->api_token) {
            return \App\User::where('api_token', $token)->first();
        }
    }
    return null;
}

function getFileUrl($path)
{
    if (startsWith('storage')) {
        return getUrl() . $path;
    }

}

function getUrl()
{
    return 'https://image.lollipop.work/';
}

function getPath($path)
{
    info($path);
    return substr($path, stripos($path, 'storage'));
}

function getFFMpeg()
{
    $path = [
        'ffmpeg.binaries'  => config('ffmpeg.ffmpeg.binaries'),
        'ffprobe.binaries' => config('ffmpeg.ffprobe.binaries'),
    ];

    return FFMpeg\FFMpeg::create($path);
}
