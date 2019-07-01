// <?php

// namespace App\Http\Requests;

// use Illuminate\Foundation\Http\FormRequest;

// // 新規ユーザー登録のバリデーションを行うクラス
// class CreateUserRequest extends FormRequest
// {
//     /**
//      * Determine if the user is authorized to make this request.
//      *
//      * @return bool
//      */
//     public function authorize()
//     {
//         return false;
//     }

//     /**
//      * Get the validation rules that apply to the request.
//      *
//      * @return array
//      */
//     public function rules()
//     {
//         return [
//             "name" => "required|string|max:15",
//             "email" => "required|string|email|max:50|unique:users",
//             "password" => "required|string|min:6|confirmed",
//         ];
//     }
// }
