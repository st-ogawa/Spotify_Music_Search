<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/public','PublicController@index');
Route::get('/public','PublicController@getMusicData');
Route::delete('/public/{id}', 'PublicController@delete');


Route::post('/register', 'AuthController@userRegister');
Route::post('/login', 'AuthController@login');

Route::post('/favorite','FavoriteController@index');
Route::get('/favorite','FavoriteController@getMusicData');
Route::delete('/favorite/{id}', 'FavoriteController@deleteMusicData');