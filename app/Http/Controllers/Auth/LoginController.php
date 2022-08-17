<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\AuthController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;


class LoginController extends AuthController
{

    use ThrottlesLogins;

    //ログイン試行回数上限
    protected $maxAttempts = 3;

    //ログインロックタイム

    protected $decayMinutes = 1;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * ログイン処理の実行
     */

     public function login(Request $request){
        
        $this->alreadyLogin($request);

        $this->validateLogin($request);

        if(method_exists($this, 'hasTooManyLoginAttemps') && $this->hasTooManyLoginAttemps($request)){

            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if($this->attemptLogin($request)){

            $request->session()->regenerate();

            // $this->clearLoginAttemps($request);

            return $this->responseSuccess('ログインしました',[
                'user' => $request->user()
            ]);
        }

        $this->incrementLoginAttempts($request);

        return $this->responseInvalid('Eメールかパスワードに誤りがあります。',[
            $this->username() => [trans('auth.failed')]
        ]);

     }

     /**
     * ログアウト処理の実行とセッションの破棄、セッションidの再発行
     *@param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 
     */

     public function logout(Request $request){

        $this->getGuard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $this->responseSuccess('ログアウトしました');
        
    }

    /**
     * ユーザ情報
     */

     public function auth(){
        $result = false;
        $user = [];
        if(Auth::check()){
            $user = Auth::user();
            $result = true;
        }

        return response()->json(['result' => $result, 'user' => $user]);
     }

     public function user(Request $request){
        return $request->user();
     }
}
