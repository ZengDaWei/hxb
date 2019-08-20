<?php

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/file', function (Request $request) {
    list($width, $height, $type, $attr) = getimagesize("http://image.lollipop.work/storage/62nYRRZt5uDNzAP.png");
    echo "Image width " . $width;

    echo "<br/>";

    echo "Image height " . $height;

    echo "<br/>";

    echo "Image type " . $type;

    echo "<br/>";

    echo "Attribute " . $attr;

});
