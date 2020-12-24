<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;

class CommentController extends Controller
{
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
        $comment = auth()->user()->comments()->create($request->all());
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
        if($this->checkRole($comment) === true) {
            if($comment->delete()) {
                return $this->returnResponseSuccessMessages(__('apiError.delete_success', ['name' => __('general.comment')]));
            }  else {
                return $this->returnResponseError('E009' , __('apiError.server_error') ,500);
            }
        } else {
            return $this->returnResponseError('E022' , __('apiError.unauthorized', ['name' => __('general.comment')]) , 403);
        }
    }
}
