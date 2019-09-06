<?php

namespace App\Services\Implments;

use App\Helpers\FFMpegUtil;
use App\Image;
use App\Services\FileService;
use App\Video;
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
            // 1.判断是否已经存在此图
            $path  = $file->getRealPath();
            $hash  = md5_file($path);
            $image = Image::firstOrNew(['json->hash' => $hash]);
            if ($image->id) {
                $image->touch();
                return $image;
            }
            $cdn_path = $this->saveFile($file);
            // 2. 保存到云
            $image->setImageInfo($cdn_path);
            // 3.获取相对路径
            $real_path   = getPath($cdn_path);
            $image->path = $real_path;
            // 4.保存到 db
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

            // 1.判断是否存在此视频
            $path  = $file->getRealPath();
            $hash  = md5_file($path);
            $video = Video::firstOrNew(['json->hash' => $hash]);
            if ($video->id) {
                $video->touch();
                return $video;
            }

            // 2.保存到 云
            $cdn_path = $this->saveFile($file);
            $db_path  = getPath($cdn_path);

            // 3.获取截图
            $fileName = FFMpegUtil::getCover($path, 1);
            $image    = $this->saveImagetoQiniu(new UploadedFile(storage_path($fileName), 'file.jpg'));

            //4.设置视频信息
            $data     = [];
            $data     = FFMpegUtil::getVideoInfo($path);
            $duration = array_get($data, 'duration');
            $duration = $duration > 0 ? ceil($duration) : $duration;

            $video->path    = $db_path;
            $video->user_id = $user->id;
            $video->setJsonData('width', array_get($data, 'width'));
            $video->setJsonData('height', array_get($data, 'height'));
            $video->duration = $duration;
            $video->setJsonData('cover', $image->path);
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
