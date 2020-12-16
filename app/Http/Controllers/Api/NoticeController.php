<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoticeRequest;
use App\Models\Notice;
use App\Traits\apiTraitFunction;
use Illuminate\Http\Request;

class NoticeController extends Controller
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
    public function store(NoticeRequest $request)
    {
        $request['user_id'] = auth()->id();
        Notice::create($request->only('story_id' , 'user_id' , 'description'));
        return $this->returnResponseSuccessMessages('created noticed successfully');
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
        $notice = Notice::findOrFail($id);
        if($notice->user_id == auth()->id()) {
            if($notice->delete()) {
                return $this->returnResponseSuccessMessages('Deleted Successfully');
            } else {
                return $this->returnResponseError('E012' , 'server error not deleted' , 500);
            }
        } else {
            return $this->returnResponseError('E013' , 'You Can\'t deleted you don\'t own it' , 403);
        }
    }
}
