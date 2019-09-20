<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

use App\User;

class UpdateUserRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
     
    use RefreshDatabase;
    use WithoutMiddleware;
    
    public function test_user_can_see_song_edit_page()
    {   
        // ユーザーを1人作成
        $user = factory(User::class)->create([
            "name" => "AAA",
            "email" => "BBB@gmail.com",
            "age" => 20,
            "gender" => 1,
            "favorite_music_age" => 1970,
            "favorite_artist" => "cccccc",
            "comment" => "dddddd"
        ]);
        
        //プロフィール編集画面を表示する
        $response = $this->actingAs($user)->get(route("users.edit", [$user]));
        $response->assertStatus(200);
    }
    
    public function test_request_should_pass_when_data_is_provided()
    {   
        $this->withoutExceptionHandling();
        
        // ユーザーを1人作成
        $user = factory(User::class)->create([
            "name" => "AAA",
            "email" => "BBB@gmail.com",
            "age" => 20,
            "gender" => 1,
            "favorite_music_age" => 1970,
            "favorite_artist" => "cccccc",
            "comment" => "dddddd"
        ]);
        
        
         
        // プロフィールを更新する   
        $response = $this->actingAs($user)->put(route("users.update", [$user]), [
            "name" => "EEE",
            "email" => "FFF@gmail.com",
            "age" => 30,
            "gender" => 2,
            "favorite_music_age" => 1980,
            "favorite_artist" => "gggggg",
            "comment" => "hhhhhh"
        ]);
        
        // dd($user);
        
        // プロフィール画面に戻る
        $response->assertStatus(302);
        $response->assertRedirect(route("users.show", [$user]));
        
        // プロフィールが更新されていることを確認
        $this->assertDatabaseHas('users', [
            "name" => "EEE",
            "email" => "FFF@gmail.com",
            "age" => 30,
            "gender" => 2,
            "favorite_music_age" => 1980,
            "favorite_artist" => "gggggg",
            "comment" => "hhhhhh"
        ]);
    }
    
    public function test_request_should_fail_when_no_name_is_provided()
    {
        // ユーザーを1人作成
        $user = factory(User::class)->create([
            "name" => "AAA",
            "email" => "BBB@gmail.com",
            "age" => 20,
            "gender" => 1,
            "favorite_music_age" => 1970,
            "favorite_artist" => "cccccc",
            "comment" => "dddddd"
        ]);
         
        // ユーザー名を空白のままで、プロフィールの更新を試みる   
        $response = $this->actingAs($user)->from(route("users.show", [$user]))->put(route("users.update", [$user]), [
            "name" => "",
            "email" => "FFF@gmail.com",
            "age" => 30,
            "gender" => 2,
            "favorite_music_age" => 1980,
            "favorite_artist" => "gggggg",
            "comment" => "hhhhhh"
        ]);
        
        // プロフィール編集画面に戻る
        $response->assertStatus(302);
        $response->assertRedirect(route("users.show", ["id" => $user->id]));
        
        // プロフィールが更新されて保存されてないことを確認
        $this->assertDatabaseMissing('users', [
            "name" => "",
            "email" => "FFF@gmail.com",
            "age" => 30,
            "gender" => 2,
            "favorite_music_age" => 1980,
            "favorite_artist" => "gggggg",
            "comment" => "hhhhhh"
        ]);
    }
    
    public function test_request_should_fail_when_no_email_is_provided()
    {
        // ユーザーを1人作成
        $user = factory(User::class)->create([
            "name" => "AAA",
            "email" => "BBB@gmail.com",
            "age" => 20,
            "gender" => 1,
            "favorite_music_age" => 1970,
            "favorite_artist" => "cccccc",
            "comment" => "dddddd"
        ]);
         
        // メールアドレスを空白のままでプロフィールの更新を試みる   
        $response = $this->actingAs($user)->from(route("users.edit", [$user]))->put(route("users.update", [$user]), [
            "name" => "EEE",
            "email" => "",
            "age" => 30,
            "gender" => 2,
            "favorite_music_age" => 1980,
            "favorite_artist" => "gggggg",
            "comment" => "hhhhhh"
        ]);
        
        // プロフィール編集画面に戻る
        $response->assertStatus(302);
        $response->assertRedirect(route("users.edit", ["id" => $user->id]));
        
        // プロフィールが更新されて保存されていないことを確認
        $this->assertDatabaseMissing('users', [
            "name" => "EEE",
            "email" => "",
            "age" => 30,
            "gender" => 2,
            "favorite_music_age" => 1980,
            "favorite_artist" => "gggggg",
            "comment" => "hhhhhh"
        ]);
    }
}
