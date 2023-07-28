<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        return [
            'lastname' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'postcode' => ['required', 'regex:/^[0-9]{3}-[0-9]{4}$/', 'max:8'],
            'address' => ['required'],
            'option' => ['required', 'string', 'max:120'],
        ];
    }

    public function messages()
     {
         return [
             'lastname.required' => '名前を入力してください',
             'firstname.required' => '名前を入力してください',
             'email.required' => 'メールアドレスを入力してください',
             'email.email' => 'メールアドレスの形式で入力してください',
             'postcode.required' => '郵便番号を入力してください',
             'postcode.regex' => 'ハイフンを含む8桁で入力してください',
             'address.required' => '住所を入力してください',
             'option.required' => 'ご意見を入力してください',
             'option.max' => 'ご意見を120文字以内で入力してください',
         ];
     }

}
