<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FavoriteRequest;
use App\Http\Resources\FavoriteResource;
use App\Models\Favorite;

class FavoriteController extends Controller
{
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
        return $this->returnResponseError('E011' , __('apiError.empty_favorite') , 204);
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
        if ($fav->where(['article_id' => $request->input('article_id'), 'user_id' => auth()->id()])->exists()) { // check favorite if already exists
            return $this->returnResponseError('E010', __('apiError.favorite_exists') , '406');
        }
        $fav->create(['article_id' => $request->input('article_id'), 'user_id' => auth()->id()]);
        return $this->returnResponseSuccessMessages(__('apiError.send_success', ['name' => __('general.favorite')]));
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
        if($this->checkRole($favorite)) {
            if($favorite->delete()) {
                return $this->returnResponseSuccessMessages(__('apiError.delete_success', ['name' => __('general.favorite')]));
            } else {
                return $this->returnResponseError('E012' , __('apiError.server_error') , 500);
            }
        } else {
            return $this->returnResponseError('E013' , __('apiError.unauthorized', ['name' => __('general.favorite')]) , 403);
        }
    }
}
