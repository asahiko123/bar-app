<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cards;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function like(string $id){

        $cards = Cards::where('id', $id)->with('favorite')->first();

        if(!$cards){
            abort('404');
        }

        $cards->favorite()->detach(Auth::user()->id);
        $cards->favorite()->attach(Auth::user()->id);

        return ["cards_id" => $id];
    }

    public function unlike(string $id){

        $cards = Cards::where('id',$id)->with('favorite')->first();

        if(!$cards){
            abort('404');
        }

        $cards->favorite()->detach(Auth::user()->id);

        return ["cards_id" => $id];
    }
}
