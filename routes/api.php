<?php

use Illuminate\Http\Request;
use Laravel\Passport\Passport;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// ログインしているユーザーの情報を返す
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// ユーザー登録
Route::post('signup', 'Api\UsersController@create');

Route::group(['middleware' => ['auth:api']], function () {
    // ユーザー一覧取得
    Route::get('users', 'Api\UsersController@index');
    // ユーザー情報取得
    Route::get('/user/{id}', 'Api\UsersController@show');
    // ユーザー情報更新
    Route::put('user/update/{id}', 'Api\UsersController@update');
    // 曲一覧取得
    Route::get('songs', 'Api\SongsController@index');
    // 曲の追加
    Route::post('song', 'Api\SongsController@store');
    // 曲の更新
    Route::put('song/{id}', 'Api\SongsController@update');
});