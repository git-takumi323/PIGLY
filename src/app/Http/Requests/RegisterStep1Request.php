<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStep1Request extends FormRequest
{
    /**
     * ユーザーがこのリクエストを許可されているかを判定
     */
    public function authorize(): bool
    {
        return true; // 認証は不要なのでtrue
    }

    /**
     * バリデーションルールを定義
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'], // 一意性チェックを追加
            'password' => 'required|string|min:8',
        ];
    }

    /**
     * エラーメッセージを定義
     */
    public function messages(): array
    {
        return [
            'name.required' => 'お名前を入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
            'password.required' => 'パスワードを入力してください',
        ];
    }
}
