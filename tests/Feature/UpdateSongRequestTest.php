<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

use App\User;
use App\Song;

class UpdateSongRequestTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
     
    use RefreshDatabase;
    use WithoutMiddleware;
    
    // protected $user;
    // protected $song;
     
    // protected function setUp() :void
    // {   
    //     parent::setUp();
        
    //     $this->user = factory(User::class)->create();
        
    //     $this->song = factory(Song::class)->create([
    //         "user_id" => $this->user->id,
    //         "title" => "AAA",
    //         "artist_name" => "BBB",
    //         "music_age" => 1970,
    //     ]);
        
    //     // dd($this->user);
    //     // dd($this->song);
    // }
     
    public function test_user_can_see_song_edit_page()
    {
        // ユーザーを1人作成
        $user = factory(User::class)->create();
        
        //曲を投稿する
        $song = factory(Song::class)->create([
            "user_id" => $user->id,
            "title" => "AAA",
            "artist_name" => "BBB",
            "music_age" => 1970,
        ]);
        
        
        //曲の編集画面を表示する
        // $response = $this->actingAs($this->user)->get(route("songs.edit", [$this->song->id]));
        $response = $this->actingAs($user)->get(route("songs.edit", [$song]));
        $response->assertStatus(200);
    }
    
    public function test_request_should_pass_when_data_is_provided()
    {   
        $this->withoutExceptionHandling();
        
        // ユーザーを1人作成
        $user = factory(User::class)->create();
        
        // 曲を投稿する
         $song = factory(Song::class)->create([
            "user_id" => $user->id,
            "title" => "AAA",
            "artist_name" => "BBB",
            "music_age" => 1970,
        ]);
        
        // 曲情報を更新する
        // $response = $this->actingAs($user)->put(route("songs.update", [$song->id]),[
        $response = $this->actingAs($user)->put(route("songs.update", [$song]),[
        // $response = $this->actingAs($this->user)->put(route("songs.update", [$this->song->id]),[
            "title" => "CCC",
            "artist_name" => "DDD",
            "music_age" => 1980,
        ]);
        
        // 曲詳細ページに戻る
        $response->assertStatus(302);
        // dd($this->song);
        // $response->assertRedirect(route("songs.show", [$this->song]));
        $response->assertRedirect(route("songs.show", [$song]));
        
        
        // 更新された曲がデータベースに保存されていることを確認する
        $this->assertDatabaseHas("songs", [
            // "user_id" => $this->user->id,
            "user_id" => $user->id,
            "title" => "CCC",
            "artist_name" => "DDD",
            "music_age" => 1980,
        ]);
        
    }
    
    public function test_request_should_fail_when_no_title_is_provided()
    {   
        $this->withoutExceptionHandling();
        
        // ユーザーを1人作成
        $user = factory(User::class)->create();
        
        //曲を投稿する
        $song = factory(Song::class)->create([
            "user_id" => $user->id,
            "title" => "AAA",
            "artist_name" => "BBB",
            "music_age" => 1970,
        ]);
        
        // 曲名を空白のまま曲情報の更新を試みる
        // $response = $this->actingAs($this->user)->put(route("songs.update", [$this->song->id]), [
        $response = $this->actingAs($user)->put(route("songs.update", [$song]), [
            "title" => "",
            "artist_name" => "BBB",
            "music_age" => 1970
        ]);
        
        // dd($this->user);
        
        // 曲編集ページが表示される
        $response->assertStatus(302);
        // $response->assertRedirect(route("songs.edit", [$this->song->id]));
        $response->assertRedirect(route("songs.edit", [$song]));
        
        // 曲情報が更新されて保存されていないことを確認する
        $this->assertDatabaseMissing("songs", [
            // "user_id" => $this->user->id,
            "user_id" => $user->id,
            "title" => "",
            "artist_name" => "BBB",
            "music_age" => 1970,
        ]);
    }
    
    public function test_request_should_fail_when_no_artist_name_is_provided()
    {   
         // ユーザーを1人作成
        $user = factory(User::class)->create();
        
        //曲を投稿する
         $song = factory(Song::class)->create([
            "user_id" => $user->id
        ]);
        
        // アーティスト名を空白のまま曲情報の更新を試みる
        $response = $this->actingAs($user)->put(route("songs.update", [$song]),[
            "title" => "",
            "artist_name" => "BBB",
            "music_age" => 1970
        ]);
        
        // 曲編集ページに戻る
        $response->assertStatus(302);
        $response->assertRedirect(route("songs.edit", [$song]));
        
        // 曲情報が更新されて保存されていないことを確認する
        $this->assertDatabaseMissing("songs", [
            "user_id" => $user->id,
            "title" => "AAA",
            "artist_name" => "",
            "music_age" => 1970,
        ]);
    }
    
    public function test_request_should_fail_when_no_music_age_is_provided()
    {   
         // ユーザーを1人作成
        $user = factory(User::class)->create();
        
        //曲を投稿する
         $song = factory(Song::class)->create([
            "user_id" => $user->id
        ]);
        
        // 音楽の年代を空白のまま曲情報の更新を試みる
        $response = $this->actingAs($user)->put(route("songs.update", [$song]),[
            "title" => "AAA",
            "artist_name" => "BBB",
            "music_age" => ""
        ]);
        
        // 曲編集ページに戻る
        $response->assertStatus(302);
        $response->assertRedirect(route("songs.edit", [$song]));
        
        // 曲情報が更新されて保存されていないことを確認する
        $this->assertDatabaseHas("songs", [
            "user_id" => $user->id,
            "title" => "AAA",
            "artist_name" => "BBB",
            "music_age" => "",
        ]);
    }
}