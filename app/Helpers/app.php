<?php

function getUser()
{
    if (Auth::check()) {
        return Auth::user();
    }

    if (auth('api')->user()) {
        return auth('api')->user();
    }

    $user = session('user');
    if (!$user) {
        if ($user = request()->user()) {
            return $user;
        }
        if ($token = request()->api_token) {
            return \App\User::where('api_token', $token)->first();
        }
    }
    return null;
}
