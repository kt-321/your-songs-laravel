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

// // 未ログイン時
// Route::group(["middleware" => "guest"], function(){
//     // 未ログイン時のトップページ
//     Route::get("/", "WelcomeController@welcome")->name("welcome");
    
//     // ユーザ登録
//     Route::get("signup", "Auth\RegisterController@showRegistrationForm")->name("signup.get");
//     Route::post("signup", "Auth\RegisterController@register")->name("signup.post");
    
//     // ログイン認証
//     Route::get("login", "Auth\LoginController@showLoginForm")->name("login");
//     Route::post("login", "Auth\LoginController@login")->name("login.post");
    
//     // SNS認証
//     Route::get("login/{provider}", "Auth\SocialAccountController@redirectToProvider")->name("socialOAuth");
//     Route::get("login/{provider}/callback", "Auth\SocialAccountController@handleProviderCallback")->name("oauthCallback");
   
// });

// // ログインしている全ユーザー
// Route::group(["middleware" => ["auth", "can:user-higher"]], function(){
//     // ログイン時のトップページ
//     Route::get("/home", "SongsController@index")->name("home");
    
//     // ログアウト
//     Route::get("logout", "Auth\LoginController@logout")->name("logout.get");
    
//     // ユーザープロフィール詳細・マイプロフィール編集・マイプロフィール更新
//     Route::resource("users", "UsersController", ["only" => ["show", "edit", "update"]]);
    
//     // 曲の一覧表示・登録画面表示・登録処理・取得表示・更新画面表示・更新処理・削除処理
//     Route::resource("songs", "SongsController");
    
//     // 曲へのコメントの投稿・削除
//     Route::resource("comments", "CommentsController", ["only" =>["store", "destroy"]]);
    
//     Route::group(["prefix" => "users/{id}"], function(){
//         Route::post("follow", "UserFollowController@store")->name("user.follow");
//         Route::delete("unfollow", "UserFollowController@destroy")->name("user.unfollow");
//         Route::get("followings", "UsersController@followings")->name("users.followings");
//         Route::get("followers", "UsersController@followers")->name("users.followers");
//         Route::get("favorites", "UsersController@favorites")->name("users.favorites");
//         Route::get("images", "UserImagesController@uploadForm")->name("users.imagesUploadForm");
//         Route::post("images", "UserImagesController@upload")->name("users.imagesUpload");
//     });
    
//     Route::group(["prefix" => "songs/{id}"], function(){
//         Route::post("favorite", "FavoritesController@store")->name("favorites.favorite");
//         Route::delete("unfavorite", "FavoritesController@destroy")->name("favorites.unfavorite");
//         Route::get("images", "SongImagesController@uploadForm")->name("songs.imagesUploadForm");
//         Route::post("images", "SongImagesController@upload")->name("songs.imagesUpload");
//     });
    
//     Route::group(["prefix" => "search"], function(){
//         // ユーザーの検索機能
//         Route::get("users", "UsersController@search")->name("users.search");
//         // 曲の検索機能
//         Route::get("songs", "SongsController@search")->name("songs.search");
//     });
    
//     // YouTubeのキーワード検索機能
//     Route::get("youtube", "YouTubeController@index")->name("youtube.index");
// });

// // 管理者権限機能
// Route::group(["middleware" => ["auth", "can:admin-higher"]], function(){
//         Route::get("index-for-admin", "SongsController@indexForAdmin")->name("songs.indexForAdmin");
//         Route::get("delete/{id}", "SongsController@delete")->name("songs.delete");
//         Route::get("restore/{id}", "SongsController@restore")->name("songs.restore");
//         Route::get("force-delete/{id}", "SongsController@forceDelete")->name("songs.forceDelete");
// });
