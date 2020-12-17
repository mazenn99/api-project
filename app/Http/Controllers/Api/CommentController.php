<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Traits\apiTraitFunction;

class CommentController extends Controller
{
    use apiTraitFunction;
    public function __construct() {
        $this->middleware('auth:api');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $comment = auth()->user()->comments()->create($request->except('apiPassword'));
        return new CommentResource($comment);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        if(auth()->id() == $comment->user_id) {
            if($comment->delete()) {
                return $this->returnResponseSuccessMessages('Deleted Comment Successfully');
            }  else {
                return $this->returnResponseError('E009' , 'error not deleted please try again later' ,500);
            }
        } else {
            return $this->returnResponseError('E022' , 'Unauthorized : you don\'t own this comment you can\'t delete it' , 403);
        }
    }
}
