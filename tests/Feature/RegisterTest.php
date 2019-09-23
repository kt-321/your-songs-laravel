<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

use Hash;

use App\User;

use Auth;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
     
    use RefreshDatabase;
    use WithoutMiddleware;
    
    public function test_user_can_see_signup_page()
    {   
        //ユーザー登録画面を表示する
        $response = $this->get(route("signup.get"));
        $response->assertStatus(200);
    }
    
    public function test_request_should_pass_when_data_is_provided()
    {   
        $this->withoutExceptionHandling();
        
        // ユーザー登録
        $response = $this->from(route("welcome"))->post(route("signup.post"),[
            "name" => "aaa",
            "email" => "bbb@gmail.com",
            "password" => "cccccc",
            "password_confirmation" => "cccccc"
        ]);
        
        // // ユーザー登録成功後、トップページにページ移動
        $response->assertStatus(302);
        $response->assertRedirect(route("home"));
        
        // データベースのusersテーブルに追加されていることを確認
        $this->assertDatabaseHas("users", [
            "name" => "aaa",
            "email" => "bbb@gmail.com",
        ]);
        
        $user = User::where("email", "bbb@gmail.com")->first();
        $this->assertTrue(Hash::check("cccccc", $user->password));
    }
    
    public function test_request_should_fail_when_no_name_is_provided()
    {   
        // ユーザー名を空白の状態でユーザー登録を試みる
        $response = $this->from(route("signup.get"))->post(route("signup.post"),[
            "name" => "",
            "email" => "bbb@gmail.com",
            "password" => "cccccc",
            "password_confirmation" => "cccccc",
        ]);
        
        // ユーザー登録に失敗し、同画面に戻る
        $response->assertStatus(302);
        $response->assertRedirect(route("signup.get"));
        
        // データベースのusersテーブルに追加されていないことを確認
        $this->assertDatabaseMissing("users", [
            "name" => "",
            "email" => "bbb@gmail.com",
        ]);
    }
    
    public function test_request_should_fail_when_no_email_is_provided()
    {   
       // メールアドレスを空白の状態でユーザー登録を試みる
        $response = $this->from(route("signup.get"))->post(route("signup.post"),[
            "name" => "aaa",
            "email" => "",
            "password" => "cccccc",
            "password_confirmation" => "cccccc"
        ]);
        
        // ユーザー登録に失敗し、同画面に戻る
        $response->assertStatus(302);
        $response->assertRedirect(route("signup.get"));
        
        // データベースのusersテーブルに追加されていないことを確認
        $this->assertDatabaseMissing("users", [
            "name" => "aaa",
            "email" => "",
        ]);
    }
    
    public function test_request_should_fail_when_no_password_is_provided()
    {   
        // パスワードを空白のままユーザー登録を試みる
        $response = $this->from(route("signup.get"))->post(route("signup.post"),[
            "name" => "aaa",
            "email" => "bbb@gmail.com",
            "password" => "",
            "password_confirmation" => "",
        ]);
        
        // ユーザー登録に失敗し、同画面に戻る
        $response->assertStatus(302);
        $response->assertRedirect(route("signup.get"));
        
        // データベースのusersテーブルに追加されていないことを確認
        $this->assertDatabaseMissing("users", [
            "name" => "aaa",
            "email" => "bbb@gmail.com",
        ]);
    }
    
    public function test_request_should_fail_when_password_doesnot_match_password_confirmation()
    {   
        // パスワード記入欄の値とパスワード確認欄の値が異なるままユーザー登録を試みる
        $response = $this->from(route("signup.get"))->post(route("signup.post"),[
            "name" => "aaa",
            "email" => "bbb@gmail.com",
            "password" => "cccccc",
            "password_confirmation" => "dddddd"
        ]);
        
        // ユーザー登録に失敗し、同画面に戻る
        $response->assertStatus(302);
        $response->assertRedirect(route("signup.get"));
        
        // データベースのusersテーブルに追加されていないことを確認
        $this->assertDatabaseMissing("users", [
            "name" => "aaa",
            "email" => "bbb@gmail.com",
            "password" => bcrypt("cccccc"),
        ]);
    }
}
