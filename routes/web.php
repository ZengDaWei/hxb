<?php

Route::get('/', function () {
    return view('welcome');
});

Route::post('/file', 'FileController@store');
