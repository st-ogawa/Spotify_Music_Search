<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/public','FavoriteController@public_index');
Route::get('/public','FavoriteController@get_public_music');
Route::delete('/public/{id}', 'FavoriteController@delete_public_music');


Route::post('/register', 'AuthController@userRegister');
Route::post('/login', 'AuthController@login');

Route::post('/favorite','FavoriteController@index');
Route::get('/favorite/{user_id}','FavoriteController@get_favorite_music');
Route::delete('/favorite/{id}', 'FavoriteController@delete_favorite');