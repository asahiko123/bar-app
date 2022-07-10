<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCards;
use App\Models\Cards;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CardsController extends Controller
{

    public function __construct(){

        $this->middleware('auth')->except(['index']);

    }
    /**
     * 投稿取得

     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cards = Cards::with(['user'])
                ->orderBy('created_at','desc')
                ->paginate();

        return $cards;

    }

    /**
     * 投稿
     *
     * @return \Illuminate\Http\Response
     */
    public function create(StoreCards $request)
    {
        $extension = $request->posted_image->extension();

        $cards = new Cards();

        $cards->posted_image = $cards->id . '.' . $extension;
        $cards->post = $request->post;

        // dd($cards->posted_image,$cards->post);

        Storage::disk('public')->putFileAs('', $request->posted_image, $cards->posted_image);

        DB::beginTransaction();

        try{
            Auth::user()->cards()->save($cards);
            DB::commit();
        } catch(Exception $exception){
            DB::rollback();

            throw $exception;
        }

        return response($cards,201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
