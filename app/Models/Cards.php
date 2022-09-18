<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class Cards extends Model
{

    /** プライマリキーの型 */
    protected $keyType = 'string';

    /** IDの桁数 */
    const ID_LENGTH = 12;

    /**
     * ユーザー定義したアクセサに関して戻り値のjsonに含まれる属性
     */

    protected $appends =[
        'url','likes_count','already_liked' 
    ];

    // protected $visible = [
    //     'id','url','likes_count','already_liked'
    // ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (! Arr::get($this->attributes, 'id')) {
            $this->setId();
        }
    }

    /**
     * ランダムなID値をid属性に代入する
     */
    private function setId()
    {
        $this->attributes['id'] = $this->getRandomId();
    }

    /**
     * ランダムなID値を生成する
     * @return string
     */
    private function getRandomId()
    {
        $characters = array_merge(
            range(0, 9), range('a', 'z'),
            range('A', 'Z'), ['-', '_']
        );

        $length = count($characters);

        $id = "";

        for ($i = 0; $i < self::ID_LENGTH; $i++) {
            $id .= $characters[random_int(0, $length - 1)];
        }

        return $id;
    }

     /**
     * Userモデルとのリレーション
     * @param 'App\Models\User'
     * @param string $localkey
     * @param string $foreignkey
     * @param string $parent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id','users');
    }

    public function favorite(){
        return $this->belongsToMany('App\Models\User','favorites','cards_id','user_id');
    }

    /**
     * URLアクセサ
     * @return string
     */
    
    public function getUrlAttribute(){
        return Storage::url($this->attributes['posted_image']);
    }

    /**
     * いいね数アクセサ
     * @return int
     */

    public function getLikesCountAttribute(){
        return $this->favorite->count();
    }

    /**
     * いいね済み判定アクセサ
     * @return boolean
     */

     public function getAlreadyLikedAttribute(){

        if(Auth::guest()){
            return false;
        }

        return $this->favorite->contains(function($user){
            return $user->id === Auth::user()->id;
        });


     }


}
