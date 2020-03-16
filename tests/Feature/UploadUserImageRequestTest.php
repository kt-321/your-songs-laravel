<?php
// namespace Tests\Feature;
// use Tests\TestCase;
// use Illuminate\Http\UploadedFile;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithoutMiddleware;
// use App\User;
// use App\Song;

// class UploadUserImageRequestTest extends TestCase
// {
//     /**
//      * A basic feature test example.
//      *
//      * @return void
//      */
     
//     use RefreshDatabase;
//     use WithoutMiddleware;
    
//     public function test_user_can_see_user_image_upload_form()
//     {
//         // ユーザーを1人作成
//         $user = factory(User::class)->create();
        
//         // ユーザー画像のアップロード画面に移動する
//         $response = $this->actingAs($user)->get(route("users.imagesUploadForm", ["id" => $user->id]));
//         $response->assertStatus(200);
//     }
    
//     //public function test_upload_user_image_request_should_pass_when_file_is_provided()
//     //{   
//         // ユーザーを1人作成
//     //    $user = factory(User::class)->create();
        
//     //    $uploadedFile = UploadedFile::fake()->image("avatar.jpg");
        
//         //画像をアップロードする
//     //    $response = $this->actingAs($user)->post(route("users.imagesUpload", ["id" => $user->id]),[
//     //        "file" => $uploadedFile,
//     //    ]);
        
//         // ユーザー画像をアップロード後にマイページに戻る
//     //    $response->assertRedirect(route("users.show", ["id" => $user->id]));
        
//         // S3にアップロードされたかはS3のバケットを確認しました。
//     //}
    
//     //public function test_upoad_user_image_request_should_fail_when_no_file_is_provided()
//     //{   
//         // ユーザーを1人作成
//     //    $user = factory(User::class)->create();
        
//         //ファイルを選択せずに画像のアップロードを試みる
//     //    $response = $this->actingAs($user)->from(route("users.imagesUploadForm", ["id" => $user->id]))->post(route("users.imagesUpload", ["id" => $user->id]),[
//     //        "file" => "",
//     //    ]);
        
//         // アップロードに失敗し、ユーザー画像のアップロード画面が表示される
//     //    $response->assertStatus(302);
//     //    $response->assertRedirect(route("users.imagesUploadForm", ["id" => $user->id]));
        
//         // S3にアップロードされていないことをS3のバケットにて確認しました。
//     //}
// }
