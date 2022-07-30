<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;
use Socialite;

class SocialiteController extends Controller
{

    /**
     * OAuth認可画面URL取得API
     * @param string $provider
     * @return \Illuminate\Http\JsonResponse
     */

    public function getProviderOAuthURL(string $provider){

        var_dump('OAuth proceeding');

        $redirectUrl = Socialite::driver($provider)
                       ->redirect()
                       ->getTargetUrl();
        
        return response()->json([
            'redirect_url' => $redirectUrl,
        ]);
    }

    public function handleProviderCallback(string $provider){

        try{
            $providerUser = Socialite::driver($provider)->user();
        }catch(Exception $e){
            abort(500, $e->getMessage());
        }

        $authUser = User::socialFindOrCreate($providerUser,$provider);
        Auth::login($authUser,true);

        return $authUser;
    }
}
