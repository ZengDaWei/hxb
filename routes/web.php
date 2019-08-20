<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/file', function (Request $request) {
    Storage::disk('qiniu')->write('image.jpg', $request->file('image'));
});
