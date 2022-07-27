<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;
use Socialite;

class SocialiteController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo ='/home';

    public function redirectToProvider($social){
        return Socialite::driver($social)->redirect();
    }

    public function handleProviderCallback($provider){
        try{
            $user = Socialite::driver($provider)->user();
        }catch(Exception $e){
            return redirect('/login');
        }

        $authUser = $this->findOrCreateUser($user,$provider);
        Auth::login($authUser,true);
        return redirect($this->redirectTo);

    }

    public function findOrCreateUser($providerUser,$provider){
       
    }
}
