<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/public','FavoriteController@index');

Route::get('/public','FavoriteController@getMusicData');

Route::delete('/favorite/{id}', 'FavoriteController@deleteMusicData');

Route::post('/register', 'AuthController@userRegister');

Route::post('/login', 'AuthController@login');

