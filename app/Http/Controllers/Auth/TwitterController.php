<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

include 'chromephp-master/ChromePhp.php';

use Auth;
use Socialite;

class TwitterController extends Controller
{

    public function loginWithTwitter(){

        ChromePhp::log('HelloConsole');

        return Socialite::driver('twitter')->redirect();
    }

    public function callbackTwitter(){

        try{
            $user = Socialite::driver('twitter')->user();

            $userWhere = User::where('twitter_id',$user->id)->first();

            if($userWhere){

                Auth::login($userWhere);

                return redirect('/home');
            }else{

                $newUser = User::create([

                    'name' => $user->account_name,
                    'email' => $user->email,
                    'twitter_id' => $user->id,
                    'oauth_type' => 'twitter',
                    'password' => encrypt('admin595959')
                ]);

                Auth::login($newUser);

                return redirect('/home');
            }

        }catch(Exception $e){
            dd($e->getMessage());
        }
    }
}
