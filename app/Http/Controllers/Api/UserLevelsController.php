<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLevelRequest;
use App\Models\qa_user_details;
use App\Traits\apiTraitFunction;
use Illuminate\Http\Request;

class UserLevelsController extends Controller
{
    use apiTraitFunction;
    public function __construct() {
        $this->middleware('auth:api');
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserLevelRequest $request)
    {
        if(auth()->user()->level()->create($request->only('level'))) {
            return $this->returnResponseSuccessMessages('levels successfully stored');
        }
        return $this->returnResponseError('E014' , 'Server Error Please try again later' , 500);
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
    public function update(UserLevelRequest $request, $id)
    {
        $level = qa_user_details::findOrFail($id);
        if($level->user_id == auth()->id()) {
            $level->update(['user_level' => $request->input('level')]);
            return $this->returnResponseSuccessMessages('levels successfully updated');
        } else {
            return $this->returnResponseError('E010' , 'Unauthorized : you can\'t updated' , 403);
        }
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
