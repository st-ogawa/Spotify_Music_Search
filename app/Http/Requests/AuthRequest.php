<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\User;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    // public function rules()
    // {
    //     return [
            
    //        'name' => ['required','max:255'],
    //        'email' => ['required','unique:users','email'],
    //        'password' => ['required','min:8'],
           
    //     ];
    // }
    // public function message(){
    //     return [
    //         'email.required'   => 'メールアドレスを入力してください。',           
    //         'email.email'      => '正しいメールアドレスを入力してください。',      
    //         'name.required'    => '名前を入力してください。',                      
    //         'name.max'         => '名前は:max文字以内で入力してください。',   
    //         'password.required' => 'パスワードを入力してください',
    //         'password.min'      => 'パスワードは:min文字以上で入力してください。',    
    //     ];
    // }
    // protected function failedValidation(Validator $validator) {
    //     $res = response()->json([
    //         'status' => 400,
    //         'errors' => $validator->errors(),
    //     ], 400);
    //     throw new HttpResponseException($res);
    // }
    // public function withValidator(Validator $validator) {
    //     $validator->after(function ($validator){
    //         $user = User::where('name', $this->input('name'))->first();
    //         $user_id = User::select('id')->get();
    //         if(null !== $user && null !== $user_id){
    //             if($user_id === $user->id){
    //                 $validator->errors()->add('name', 'すでにログインしています。');
    //             }   
    //         }
    //     });
    // }
    // public function messages(){
    //     return [

    //     ]}
    // }

    
}
