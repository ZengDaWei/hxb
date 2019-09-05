<?php

namespace App\Services;

use App\Image;

interface FileService
{
    public function saveImagetoQiniu($file): Image;
    public function saveVideotoQiniu($video);
}
