<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCards extends FormRequest
{
    /**
     * FormRequestの使用が許可されているかどうか
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * フォーム入力値をバリデーションする
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'posted_image' => 'required|file|mimes:jpg,jpeg,png,gif',
            'post' => 'required|string|max:200'
        ];
    }
}
