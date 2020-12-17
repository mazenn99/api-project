<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FavoriteRequest;
use App\Http\Resources\FavoriteResource;
use App\Models\Favorite;
use App\Traits\apiTraitFunction;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    use apiTraitFunction;
    public function __construct() {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return FavoriteResource
     */
    public function index()
    {
        $favorites = auth()->user()->favorites()->paginate(5);
        if($favorites) {
            return FavoriteResource::collection($favorites);
        }
        return $this->returnResponseError('E011' , 'Sorry not favorite until yet' , 204);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FavoriteRequest $request)
    {
        $fav = new Favorite();
        if ($fav->where(['story_id' => $request->input('story_id'), 'user_id' => auth()->id()])->exists()) { // check favorite if already exists
            return $this->returnResponseError('E010', 'this already exists in you\'re favorite profile', '406');
        }
        $fav->create(['story_id' => $request->input('story_id'), 'user_id' => auth()->id()]);
        return $this->returnResponseSuccessMessages('added to favorite successfully');
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $favorite = Favorite::findOrFail($id);
        if($favorite->user_id == auth()->id()) {
            if($favorite->delete()) {
                return $this->returnResponseSuccessMessages('Deleted Successfully');
            } else {
                return $this->returnResponseError('E012' , 'server error not deleted' , 500);
            }
        } else {
            return $this->returnResponseError('E013' , 'You Can\'t deleted you don\'t own it' , 403);
        }
    }
}
