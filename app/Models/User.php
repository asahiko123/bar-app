<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\SocialiteProvider;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, softDeletes;

    public $timestamps = false;

    protected $table ='users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'account_name',
        'profile',
        'pref_code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * アクセサでデータを取得したときにjsonに含む属性
     */

    protected $visible = [
        'account_name'
    ];

    public static function boot(){
        parent::boot();
        static::creating(function($model){
            $model->created_at = $model->freshTimestamp();
        });
    }

    public function cards(){
        return $this->hasMany('App\Models\Cards');
    }

    public function socialiteProvider(){
        return $this->hasMany(SocialiteProvider::class);
    }

    public static function socialFindOrCreate($providerUser , $provider){
        $existingUser = SocialiteUser::whereProviderName($provider)
                    ->whereProviderUserId($providerUser->getId())
                    ->first();

        if($existingUser){


            $user = DB::transaction(function() use ($existingUser, $providerUser, $provider){
                $existingUser->update(['auth_type' => AuthType::BOTH]);
                $existingUser->socialiteProvider()->create([
                    'provider_id' => $providerUser->getId(),
                    'provider_name' => $provider,
                ]);

                return $existingUser;
            });
        } else {

            $user = DB::transaction(function() use ($providerUser, $provider){
                $providerUserName = $providerUser->getName() ? $providerUser->getName() : $providerUser->getNickname();

                $user = User::create([
                    'name' => $providerUserName,
                    'auth_type' => AuthType::SOCIAL,
                    'email' =>$providerUser->getEmail(),
                ]);

                $user->socialiteProvider()->create([
                    'provider_id' => $providerUser->getId(),
                    'provider_name' => $provider
                ]);

                return $user;
            });

        }

        return $user;
    }
}
