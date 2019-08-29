<?php

namespace App\Services;

interface FileService
{
    public function saveImagetoQiniu();
    public function saveVideotoQiniu();
}
