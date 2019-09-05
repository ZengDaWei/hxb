<?php

namespace App\Http\Controllers;

use App\Services\Implments\FileServiceImpl;
use Illuminate\Http\Request;

class FileController extends Controller
{

    protected $fileSerivce;

    public function __construct(FileServiceImpl $fileSerivce)
    {
        $this->fileSerivce = $fileSerivce;
    }

    public function index()
    {

    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        if (!$request->hasFile('file') || !$request->file('file')->isValid()) {
            return '上传的文件不合法';
        }

        $file   = $request->file('file');
        $result = $this->fileSerivce->saveImagetoQiniu($file);
    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
