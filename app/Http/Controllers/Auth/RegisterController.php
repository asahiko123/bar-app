<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\AuthController;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;

class RegisterController extends AuthController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

   public function register(Request $request){

    var_dump('qqqq');

    $this->alreadyLogin($request);

    $this->validateRegister($request);

    $token = $this->createToken();

    var_dump($token);

    $registerUser = $this->setRegisterUser($request, $token);

    if($this->attemptLogin($request)){

      var_dump('loginattempt');

        $request->session()->regenerate();

        var_dump('loginattempt2');

        // $this->clearLoginAttemps($request);

        var_dump('loginattempt3');

        return $this->responseSuccess('ログインしました',[
            'user' => $request->user()
        ]);
    }

    return $this->responseSuccess('登録が完了しました。');

    // $this->sendVerificationMail($registerUser);

   }

   /**
     * 新規ユーザーの登録
     *
     * @param Request $request, string $token
     * @return $registerUser
     */


   private function setRegisterUser(Request $request, string $token){


    $registerUser = new User($request->all());

    $registerUser->token = $token;

    $registerUser->password = $this->passwordHash($request->password);

    $registerUser->save();

    return $registerUser;
   }

   /**
     * 認証メールの送信
     *
     * @param User $registerUser
     * @return void
     */

    private function sendVerificationMail(User $registerUser){
        Mail::to($registerUser->email)->queue(new VerificationMail($registerUser->token));
    }


}
