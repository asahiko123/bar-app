<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rules\Password;

abstract class AuthController extends Controller{

    /**
     * アカウント名かメールアドレスをユーザー名に設定
     * @return string
     */

    protected function username(){
        return 'email';
    }

    /**
     * 認証名を取得（デフォルトではweb)
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */

     protected function getGuard(){
        return Auth::guard(config('auth.defaults.guard'));
     }

     /**
     * 認証に使うパラメータを取得
     *
     * @param  Request $request
     * @return Array
     */

     protected function credentials(Request $request){

        return $request->only($this->username(),'password');
     }

     /**
     * リクエストが存在し、かつ継続ログインが空でないなら認証を試行
     *
     * @param  Request $request
     * @return bool
     */

     protected function attemptLogin(Request $request){
        return $this->getGuard()->attempt(
            $this->credentials($request),$request->filled('remember')
        );
     }

     /**
     * パスワードのhashを作成
     *
     * @param string $password
     * @return string
     */

     protected function passwordHash($password){
        return Hash::make($password);
     }

     /**
     * トークンを作成する
     * @return string
     */

    protected function createToken(){
        return hash_hmac('sha256',Str::random(40),config('app.key'));
    }

    /**
     *トークンの有効期限を確認
     *
     * @param string $createdAt
     * @return bool
     */

    protected function tokenExpired($expires, $createdAt){
        
        return Carbon::parse($createdAt)
                ->addSeconds($expires)
                ->isPast();
    }

    /**
     *既にログインしているかどうか
     * @param  Request $request
     * @param string|null $message
     * @return void
     *
     * @throws HttpException
     */

    protected function alreadyLogin(Request $request,string $message = null){
        $message = is_null($message)? '既にログインしています': $message;

        if(auth()->check()){
            throw new HttpException(403, trans($message));
        }
    }

    /**
     *認証パラメーターをバリデーションする
     *
     * @param  Request $request
     * @return void
     */

    protected function validateLogin(Request $request){
        $request->validate([

            $this->username() => 'required|string',
            'password' => 'required|string',
            'remember' => 'boolean',
        ]);
    }

    /**
     * 新規登録情報のバリデーション
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validateRegister(Request $request){
        $request->validate([
            'account_name' => ['required','string','max:255'],
            'email' => ['required','string','email','max:225','unique:users'],
            'password' => ['required',Password::defaults(),'confirmed'],

        ]);
    }

    /**
     * Validate the forgot request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateForgot(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users,email'],
        ]);
    }

    /**
     *パスワードリセット時のバリデーション
     * @param  Request $request
     * @return void
     */
    protected function validateReset(Request $request)
    {
        $request->validate([
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);
    }

    /**
     * 成功のレスポンス
     *
     * @param string $message
     * @param array $additions
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseSuccess(string $message, array $additions = [])
    {
        return response()->json(array_merge(['message' => trans($message)], $additions), 200);
    }

    /**
     * 失敗のレスポンス
     *
     * @param string $message
     * @param array $additions
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseFailed(string $message)
    {
        return response()->json(['message' => trans($message)], 403);
    }

    /**
     * インヴァリッドのレスポンス
     *
     * @param string $message
     * @param array $errors array in array
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseInvalid(string $message, array $errors = [])
    {
        foreach ($errors as &$error) {
            foreach ($error as &$value) {
                $value = trans($value);
            }
        }

        return response()->json([
            'message' => trans($message),
            'errors' => $errors,
        ], 422);
    }
}