<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithoutMiddleware;


use App\User;
use App\Song;

class SaveSongRequestTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
     
    use RefreshDatabase;
    use WithoutMiddleware;
    
    public function test_user_can_see_song_post_page()
    {   
        $this->withoutExceptionHandling();
        
        // ユーザーを1人作成
        $user = factory(User::class)->create();
        
        //曲の投稿画面を表示する
        $response = $this->actingAs($user)->get(route("songs.create"));
        $response->assertStatus(200);
    }
    
    public function test_request_should_pass_when_data_is_provided()
    {
        // ユーザーを1人作成
        $user = factory(User::class)->create();
        
        //曲を投稿する
        $response = $this->actingAs($user)->post(route("songs.store"),[
            "title" => "AAA",
            "artist_name" => "BBB",
            "music_age" => 1970,
        ]);

        // プロフィール画面に戻る
        $response->assertStatus(302);
        $response->assertRedirect(route('users.show',["id" => $user->id]));
        
        // データベースに曲が保存されていることを確認
        $this->assertDatabaseHas('songs', [
            "title" => "AAA",
            "artist_name" => "BBB",
            "music_age" => 1970,
        ]);
    }
    
    public function test_request_should_fail_when_no_title_is_provided()
    {   
        // ユーザーを1人作成
        $user = factory(User::class)->create();
        
        //曲名を空白にして曲の投稿を試みる
        $response = $this->actingAs($user)->from(route("songs.create"))->post(route("songs.store"),[
            "title" => "",
            "artist_name" => "BBB",
            "music_age" => 1970,
        ]);
        
        // 同画面に戻る
        $response->assertStatus(302);
        $response->assertRedirect(route("songs.create"));
        
        // データベースに曲が存在しないことを確認
        $this->assertDatabaseMissing('songs', [
            "title" => "",
            "artist_name" => "BBB",
            "music_age" => 1970,
        ]);
        
    }
    
    public function test_request_should_fail_when_no_artist_name_is_provided()
    {   
        // ユーザーを1人作成
        $user = factory(User::class)->create();
        
        //アーティスト名を空白にして曲投稿を試みる
        $response = $this->actingAs($user)->from(route("songs.create"))->post(route("songs.store"),[
            "title" => "AAA",
            "artist_name" => "",
            "music_age" => 1970,
        ]);
        
        // 同画面に戻る
        $response->assertStatus(302);
        $response->assertRedirect(route("songs.create"));
        
        // データベースに曲が存在しないことを確認
        $this->assertDatabaseMissing('songs', [
            "title" => "AAA",
            "artist_name" => "",
            "music_age" => 1970,
        ]);
        
    }
    
    public function test_request_should_fail_when_no_music_age_is_provided()
    {   
         // ユーザーを1人作成
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)->from(route("songs.create"))->post(route("songs.store"),[
            "title" => "AAA",
            "artist_name" => "BBB",
            "music_age" => "",
        ]);
        
        // 同画面に戻る
        $response->assertStatus(302);
        $response->assertRedirect(route("songs.create"));
        
        // データベースに曲が存在しないことを確認
        $this->assertDatabaseMissing('songs', [
            "title" => "AAA",
            "artist_name" => "BBB",
            "music_age" => "",
        ]);
    }
    
}
