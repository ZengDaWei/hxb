<?php

use Illuminate\Http\Request;

Route::get('/', function () {
    $index = stripos('https://image.lollipop.work/storage/62nYRRZt5uDNzAP.png', 'storage');
    echo substr('https://image.lollipop.work/storage/62nYRRZt5uDNzAP.png', $index);
});

Route::get('/file', function (Request $request) {

});
