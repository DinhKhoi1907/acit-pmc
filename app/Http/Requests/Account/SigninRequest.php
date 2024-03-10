<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class SigninRequest extends FormRequest
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
            'username' => 'bail|required|min:6|max:255|unique:users',
            'password' => 'bail|required|min:8|max:32|',
            'repassword' => 'bail|required|same:password',
            'name' => 'bail|required',
            'phonenumber' => 'bail|required',
            'email' => 'bail|required|email|unique:users'
        ];
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
       return [
          'username.required' => __('Bạn chưa nhập Tên tài khoản'),
          'username.min' => __('Username phải có ít nhất 6 ký tự.'),
          'username.max' => __('Username phải không được vượt quá 255 ký tự.'),

          'password.required' => __('Bạn chưa nhập mật khẩu'),
          'password.min' => __('Mật khẩu phải có ít nhất 8 ký tự.'),
          'password.max' => __('Mật khẩu phải không được vượt quá 32 ký tự.'),

          'repassword.required' => __('Bạn chưa nhập lại mật khẩu'),
          'repassword.same' => __('Mật khẩu không chính xác'),

          'name.required' => __('Bạn chưa nhập họ tên'),

          'phonenumber.required' => __('Bạn chưa nhập số điện thoại'),

          'email.required' => __('Bạn chưa nhập email'),
          'email.email' => __('Email không đúng định dạng'),
          'email.unique' => __('Email này đã được sử dụng đăng ký trước đó'),
       ];
    }
}
