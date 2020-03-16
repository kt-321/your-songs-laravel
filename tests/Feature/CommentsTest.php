<?php

// namespace Tests\Feature;

// use Tests\TestCase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithoutMiddleware;

// use App\User;
// use App\Song;
// use App\Comment;

// class CommentsTest extends TestCase
// {
//     /**
//      * A basic test example.
//      *
//      * @return void
//      */
     
//     use RefreshDatabase;
//     use WithoutMiddleware;
     
//     public function test_user_can_post_comment()
//     {
//         // ユーザーを１人作成する
//         $user = factory(User::class)->create();
        
//         // 曲を１つ作成する
//         $song = factory(Song::class)->create();
        
//         // 曲にコメントを投稿する
//         $response = $this->actingAs($user)->from(route("songs.show", ["id" => $song->id]))->post(route("comments.store"), [
//             "user_id" => $user->id,
//             "song_id" => $song->id,
//             "body" => "aaa",
//         ]);
        
//         // 同画面にリダイレクト
//         $response->assertStatus(302);
//         // $response->assertRedirect("songs/{$song->id}");
//         $response->assertRedirect(route("songs.show",["id" => $song->id]));
        
//         $this->assertDatabaseHas("comments", [
//             "user_id" => $user->id,
//             "song_id" => $song->id,
//             "body" => "aaa",
//         ]);
//     }
    
//     public function test_user_can_delete_comment()
//     {   
//         // ユーザーを１人作成する
//         $user = factory(User::class)->create();
        
//         // 曲を１つ作成する
//         $song = factory(Song::class)->create();
        
//         // 曲にコメントを投稿する
//         $response = $this->actingAs($user)->from(route("songs.show", ["id" => $song->id]))->post(route("comments.store"), [
//             "user_id" => $user->id,
//             "song_id" => $song->id,
//             "body" => "aaa",
//         ]);
        
//         // 自分が投稿したコメントを削除する
//         $response = $this->actingAs($user)->from(route("songs.show", ["id" => $song->id]))->delete(route("comments.destroy", ["id" => $song->id]));
           
//         // 同画面にリダイレクト
//         $response->assertStatus(302);
//         $response->assertRedirect(route("songs.show",["id" => $song->id]));
        
//         $this->assertDatabaseMissing("comments", [
//             "user_id" => $user->id,
//             "song_id" => $song->id,
//         ]);
//     }
// }
