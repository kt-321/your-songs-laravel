<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

use App\User;
use Auth;

class UserFollowTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
     
    use RefreshDatabase;
    use WithoutMiddleware;
     
    public function test_user_can_follow()
    {
        // ユーザーを2人作成
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();
           
        // ユーザー1がユーザー2をフォローする
        $response = $this->actingAs($user1)->from(route("users.show", ["id" => $user2->id]))->post(route("user.follow", ["id" => $user2->id]));
           
        // 同じ画面にリダイレクト
        $response->assertStatus(302);
        $response->assertRedirect(route("users.show", ["id" => $user2->id]));
        
        // データベースにフォロー・フォロワーの関係が保存されていることを確認
        $this->assertDatabaseHas('user_follow', [
            "user_id" => $user1->id,
            "follow_id" => $user2->id,
        ]);
    }
    
    public function test_user_can_unfollow()
    {
        // ユーザーを2人作成
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();
           
        // ユーザー1がユーザー2をフォローする
        $response = $this->actingAs($user1)->from(route("users.show", ["id" => $user2->id]))->post(route("user.follow", ["id" => $user2->id]));
        
        // ユーザー1がユーザー2のフォローを外す
        $response = $this->actingAs($user1)->from(route("users.show", ["id" => $user2->id]))->delete(route("user.unfollow", ["id" => $user2->id]));
           
        // 同じ画面にリダイレクト
        $response->assertStatus(302);
        $response->assertRedirect(route("users.show", ["id" => $user2->id]));
        
        // データベースからフォロー・フォロワーの関係のデータがなくなっていることを確認
        $this->assertDatabaseMissing('user_follow', [
            "user_id" => $user1->id,
            "follow_id" => $user2->id,
        ]);
    }
    
    public function test_user_can_see_followings()
    {
        // ユーザーを1人作成
        $user = factory(User::class)->create();
        
        // ユーザーがフォローしているユーザー一覧を見る
        $response = $this->actingAs($user)->get(route("users.followings", ["id" => $user->id]));  
        $response->assertStatus(200);
    }
    
    public function test_user_can_see_followers()
    {
        // ユーザーを1人作成
        $user = factory(User::class)->create();
        
        // ユーザーが自分をフォローしているユーザー一覧を見る
        $response = $this->actingAs($user)->get(route("users.followers", ["id" => $user->id]));  
        $response->assertStatus(200);
    }
}
