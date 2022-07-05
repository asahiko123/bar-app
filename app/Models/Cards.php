<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

use App\Http\Helper;

class Cards extends Model
{
    use HasFactory;
   


    protected $keyType = 'string';
    protected $table = 'cards';
    public $incrementing = false;
    protected $guarded =[];
    

    protected static function boot(){

        parent::boot();

        static::creating(function($model){

            for($i = 0; $i < 5; $i++){

                
                $randomId = Helper::getRandomId();

                $exists = self::where('id',$randomId)->exists();

                if(!$exists){
                    $model->id = $randomId;
                    break;
                }
                if($i === 4){
                    Log::alert('正しくユーザーIDが作られませんでした');
                    throw new Exception('正しくユーザーIDが作られませんでした');
                }

            }
            
        });
    }

}
