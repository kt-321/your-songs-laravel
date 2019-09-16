<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// ユーザー情報編集のバリデーションを行うクラス
class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // email項目で自分を無視するときにundefined $idの回避のため
        $id = \Auth::user()->id;
        
        return [
            "name" => "required|string|max:15",
            "email" => "required|email|max:50|unique:users,email,$id",
            "age" => "nullable|integer",
            "gender" => "nullable|string",
            "favorite_music_age" => "nullable|integer",
            "favorite_artist" => "nullable|string|max:30",
            "comment" => "nullable|string|max:150"
        ];
    }
    
    public function attributes()
    {
        return [
            "name" => "名前",
            "email" => "メールアドレス",
            "age" => "年齢",
            "gender" => "性別",
            "favorite_music_age" => "好きな音楽の年代",
            "favorite_artist" => "好きなミュージシャン",
            "comment" => "自己紹介"
        ];
    }
}
