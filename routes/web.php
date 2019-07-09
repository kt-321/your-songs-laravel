<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 未ログイン時
Route::group(["middleware" => "guest"], function(){
    // 未ログイン時のトップページ
    Route::get("/", "WelcomeController@welcome")->name("welcome");
    
    // ユーザ登録
    Route::get("signup", "Auth\RegisterController@showRegistrationForm")->name("signup.get");
    Route::post("signup", "Auth\RegisterController@register")->name("signup.post");
    
    // ログイン認証
    Route::get("login", "Auth\LoginController@showLoginForm")->name("login");
    Route::post("login", "Auth\LoginController@login")->name("login.post");
   
});

// ログイン時
Route::group(["middleware" => "auth"], function(){
    // ログイン時のトップページ
    Route::get("/home", "SongsController@index")->name("home");
    
    // ログアウト
    Route::get("logout", "Auth\LoginController@logout")->name("logout.get");
    
    // ユーザー一覧・ユーザープロフィール詳細・マイプロフィール編集・マイプロフィール更新
    Route::resource("users", "UsersController", ["only" => ["index", "show", "edit", "update"]]);
    
    // 曲の一覧表示・登録画面表示・登録処理・取得表示・更新画面表示・更新処理・削除処理
    Route::resource("songs", "SongsController");
    
    Route::group(["prefix" => "users/{id}"], function(){
        Route::post("follow", "UserFollowController@store")->name("user.follow");
        Route::delete("unfollow", "UserFollowController@destroy")->name("user.unfollow");
        Route::get("followings", "UsersController@followings")->name("users.followings");
        Route::get("followers", "UsersController@followers")->name("users.followers");
    });
});
