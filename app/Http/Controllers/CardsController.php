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

        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * 投稿
     *
     * @return \Illuminate\Http\Response
     */
    public function create(StoreCards $request)
    {
        $extension = $request->posted_image->extension();
        // dd($request);

        $cards = new Cards();
        // dd($cards);

        $cards->posted_image = $cards->id . '.' . $extension;
        $cards->post = $request->post;

        var_dump($cards->posted_image);

        // dd($cards->posted_image,$cards->post);

        // Storage::cloud()
        //     ->putFileAs('', $request->photo, $photo->filename, 'public');

        Storage::disk('public')->putFile('storage/app/public/', $cards->posted_image, 'public');

        DB::beginTransaction();

        try{
            Auth::user()->cards()->save($cards);
            DB::commit();
        } catch(Exception $exception){
            DB::rollback();

            // Storage::cloud()->delete($photo->filename);
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
