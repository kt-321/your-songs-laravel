<?php
namespace Tests\Feature;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\User;
use App\Song;

class UploadSongImageRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
     
    use RefreshDatabase;
    use WithoutMiddleware;
    
    public function test_user_can_see_song_image_upload_form()
    {
        // ユーザーを1人作成
        $user = factory(User::class)->create();
        
        // 曲を1つ作成
        $song = factory(Song::class)->create();
        
        // 曲画像アップロード画面に移動する
        $response = $this->actingAs($user)->get(route("songs.imagesUploadForm", ["id" => $song->id]));
        $response->assertStatus(200);
    }
    
   // public function test_upload_song_image_request_should_pass_when_file_is_provided()
   // {   
        // ユーザーを1人作成
   //     $user = factory(User::class)->create();
        
        // 上で作ったユーザーで曲を1つ投稿
   //     $song = factory(Song::class)->create([
   //         "user_id" => $user->id,
   //     ]);
        
   //     $uploadedFile = UploadedFile::fake()->image("jacket.jpg");
        
        //画像をアップロードする
   //     $response = $this->actingAs($user)->post(route("songs.imagesUpload", ["id" => $song->id]),[
   //         "file" => $uploadedFile,
   //     ]);
        
        // 画像アップロード後に曲詳細画面に戻る
   //     $response->assertRedirect(route("songs.show", ["id" => $song->id]));
        
        // S3にアップロードされたかはS3のバケットを確認しました。
   // }
    
   // public function test_upoad_song_image_request_should_fail_when_no_file_is_provided()
   // {   
        // ユーザーを1人作成
   //     $user = factory(User::class)->create();
        
        // 上で作ったユーザーで曲を1つ投稿
   //     $song = factory(Song::class)->create([
   //         "user_id" => $user->id,
   //     ]);
        
        //ファイルを選択せずにアップロードを試みる
   //     $response = $this->actingAs($user)->from(route("songs.imagesUploadForm", ["id" => $song->id]))->post(route("songs.imagesUpload", ["id" => $song->id]),[
   //         "file" => "",
   //     ]);
        
        // アップロードに失敗し、曲画像のアップロード画面が表示される
   //     $response->assertStatus(302);
   //     $response->assertRedirect(route("songs.imagesUploadForm", ["id" => $song->id]));
        
        // S3にアップロードされていないことをはS3のバケットにて確認しました。
   // }
}
