<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

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
            'menu' => 'required|string|max:20',
            'price' => 'required|integer',
            'bar' => 'string|max:100',
            'comment' => 'required|string|max:200',
            'easyToDrink' => 'required|integer',
            'sweet' => 'required|integer',
            'dry' => 'required|integer',
            'fresh' => 'required|integer',
            'sharp' => 'required|integer',
            'mellow' => 'required|integer',

        ];
    }

    public function messages(){
        return[
            'required' => '必須項目です。',
            'max' => '文字数をオーバーしています。',
        ];
    }

   public function validated($key = null, $default = null){

    $validated = $this->validator->validated();

    return array_merge($validated,[
        'price' => (int) $this->price,
        'easyToDrink' => (int) $this->easyToDrink,
        'sweet' => (int) $this->sweet,
        'dry' => (int) $this->dry,
        'fresh' => (int) $this->fresh,
        'sharp' => (int) $this->sharp,
        'mellow' => (int) $this->mellow,
    ]);
   }


}
