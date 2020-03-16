<?php

// namespace Tests\Feature;

// use Tests\TestCase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;

// class OAuthTest extends TestCase
// {
//     /**
//      * A basic feature test example.
//      *
//      * @return void
//      */
     
//      use RefreshDatabase;
     
//     public function test_user_can_see_OAuth_page()
//     {
//         $this->providerName = "github";
//         $this->get(route("socialOAuth", ["provider" => $this->providerName]))
//             ->assertStatus(302);
//     }
    
//     public function test_user_can_signup_width_github_account()
//     {
//         $this->providerName = "github";
         
//         // URLをコール
//         $this->get(route("oauthCallback", ["provider" => $this->providerName]))
//             ->assertStatus(302);
//     }
// }