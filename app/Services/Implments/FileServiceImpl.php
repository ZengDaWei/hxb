<?php

namespace App\Services\Implments;

use App\Image;
use App\Services\FileService;
use App\Video;
use FFMpeg\Coordinate\TimeCode;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileServiceImpl implements FileService
{
    public function saveImagetoQiniu($file)
    {
        Auth::loginUsingId(1);
        if ($user = getUser()) {
            // 判断是否已经存在此图
            $path  = $file->getRealPath();
            $hash  = md5_file($path);
            $image = Image::firstOrNew(['json->hash' => $hash]);
            if ($image->id) {
                $image->touch();
                return $image;
            }
            $cdn_path = $this->saveFile($file);
            $image->setImageInfo($cdn_path);
            // 获取相对路径
            $real_path   = getPath($cdn_path);
            $image->path = $real_path;
            // 保存到 db
            $image->user_id = $user->id;
            $image->save();
            return $image;
        }
        return null;

    }
    public function saveVideotoQiniu($file)
    {
        Auth::loginUsingId(1);
        if ($user = getUser()) {
            // 判断是否存在此视频
            $path  = $file->getRealPath();
            $hash  = md5_file($path);
            $video = Video::firstOrNew(['json->hash' => $hash]);
            if ($video->id) {
                $video->touch();
                return $video;
            }
            $cdn_path  = $this->saveFile($file);
            $real_path = getPath($cdn_path);
            $ffmpeg    = getFFMpeg();
            $ffm_video = $ffmpeg->open($path);
            //提取第一秒的图像
            $frame    = $ffm_video->frame(TimeCode::fromSeconds(1));
            $fileName = 'video/' . Str::random(12) . '.jpg';
            if (!is_dir(storage_path("video"))) {
                mkdir(storage_path("video"), 0777);
            }
            $frame->save(storage_path($fileName));
            $image = $this->saveImagetoQiniu(new UploadedFile(storage_path($fileName), 'file.jpg'));

            // db
            $video->path    = $real_path;
            $video->user_id = $user->id;
            $video->setVideoInfo($image->path, $image->getJsonData('width'), $image->getJsonData('height'));
            $video->save();
        }
    }

    public function saveFile($file): string
    {
        $entension = '.' . $file->getClientOriginalExtension();
        info($entension);
        $fileName = 'storage/' . Str::random(12) . $entension;
        if (Storage::disk('qiniu')->write($fileName, file_get_contents($file->getRealPath()))) {
            return 'https://image.lollipop.work/' . $fileName;
        }
        return 'faild';
    }
}
