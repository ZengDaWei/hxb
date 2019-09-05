<?php

namespace App\Services\Implments;

use App\Image;
use App\Services\FileService;
use App\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileServiceImpl implements FileService
{
    public function saveImagetoQiniu($file): Image
    {
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
    public function saveVideotoQiniu($video)
    {
        Auth::loginUsingId(1);
        if ($user = getUser()) {
            // 判断是否存在此视频
            $path  = $video->getRealPath();
            $hash  = md5_file($path);
            $video = Video::firstOrNew(['json->hash' => $hash]);
            if ($video->id) {
                $video->touch();
                return $video;
            }
            $cdn_path = $this->saveFile($video);

            $ffmpeg = getFFMpeg();
            $video  = $ffmpeg->open($path);
            //提取第一秒的图像
            $frame    = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(1));
            $fileName = Str::random(12) . '.jpg';
            if (!is_dir(storage_path("storage/video"))) {
                mkdir(storage_path("storage/video"), 0777);
            }
            $frame->save(storage_path($fileName));
            $image = $this->saveImagetoQiniu(storage_path($fileName));
            dd($image);
        }
    }

    public function saveFile($file): string
    {
        $entension = '.' . $file->getClientOriginalExtension();
        $fileName  = 'storage/' . Str::random(12) . $entension;
        if (Storage::disk('qiniu')->write($fileName, file_get_contents($file->getRealPath()))) {
            return 'https://image.lollipop.work/' . $fileName;
        }
        return 'faild';
    }
}
