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
});