<?php

namespace App\Services;

interface FileService
{
    public function saveImagetoQiniu($file);
    public function saveVideotoQiniu($video);
}
