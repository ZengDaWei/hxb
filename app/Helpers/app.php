<?php

use Illuminate\Support\Str;

function UploadFile($file): String
{
    if ($file->isValid()) {
        $entension = '.' . $file->getClientOriginalExtension();
        $fileName  = Str::random(12) . $entension;
        if (Storage::disk('qiniu')->write($fileName, $file)) {
            return 'http://image.lollipop.work/storage/' . $fileName;
        }
        return '上传图片失败';
    }
    return '文件不合法';
}
