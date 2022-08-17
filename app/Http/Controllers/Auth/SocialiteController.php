<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;

class SocialiteController extends Controller
{

    /**
     * OAuth認可画面URL取得API
     * @param string $provider
     * @return \Illuminate\Http\JsonResponse
     */

    public function redirectToProvider(string $provider){

        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(string $provider){
        
        try{

            // if($provider === "twitter"){
                
            //     $user = Socialite::driver($provider)->userFromTokenAndSecret(env('TWITTER_AUTH_CLIENT_ID'),env('TWITTER_AUTH_CLIENT_SECRET'));
            //     dd($user);
            // }
            $user = Socialite::driver($provider)->stateless()->user();
            dd($user);
        }catch(Exception $e){
            return redirect('/login');
        }
    }

   
}
