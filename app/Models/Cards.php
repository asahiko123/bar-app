<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cards extends Model
{
    use HasFactory;


    protected $keyType = 'string';
    public $incrementing = false;

    const ID_LENGTH = 12;

    /**
     * 文字列をPrimaryKeyにしているので、Modelを作成するたびに
     * ID属性に新しいsetIdを行う
     */

    public function __construct(array $attributes =[]){

        parent::__construct($attributes);

        if(! Arr::get($this->attributes,'id')){
            $this->setId();
        }
    }

    public function setId(){
        $this->attributes['id'] = $this->getRandomId();
    }

    public function getRandomId(){

        $characters = array_merge(
            range(0,9),
            range('a','z'),
            range('A','Z'),
            ['_','-']
        );

        $length = count($characters);

        $id = '';

        for($i = 0; $i < ID_LENGTH; $i++){

            $id .= $characters[random_int(0,$length -1)];
        }

        return $id;
        
    }



}
