<?php

namespace App\Http\Helper;

class Helper{

    function getRandomId(){

        $characters = array_merge(
            range(0,9),
            range('a','z'),
            range('A','Z'),
            ['_','-']
        );
    
        $length = count($characters);
    
        $id = '';
    
        for($i = 0; $i < 12; $i++){
    
            $id .= $characters[random_int(0,$length -1)];
        }
    
        return $id;
        
    }
    
}

