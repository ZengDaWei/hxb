<?php

namespace App\Services\Implments;

use App\Image;

class FileServiceImpl implements FileService
{
    public function saveImagetoQiniu($file)
    {
        if ($user = getUser()) {
            // 判断是否已经存在此图
            $hash  = md5_file($file);
            $image = Image::firstOrNew(['json->hash' => $hash]);
            if ($image->id != null) {
                return $image;
            }
            $path = saveFile($file);
            // 获取相对路径
            $real_path = substr($path, stripos($path, 'storage'));

        }

    }
    public function saveVideotoQiniu($file)
    {

    }
    public function saveFile($file)
    {
        if ($file->isValid()) {
            $entension = '.' . $file->getClientOriginalExtension();
            $fileName  = Str::random(12) . $entension;
            if (Storage::disk('qiniu')->write($fileName, $file)) {
                return 'https://image.lollipop.work/storage/' . $fileName;
            }
            return '上传图片失败';
        }
        return '文件不合法';
    }
}
