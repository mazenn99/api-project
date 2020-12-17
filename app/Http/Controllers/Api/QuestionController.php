<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Models\QaQuestion;
use App\Traits\apiTraitFunction;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    use apiTraitFunction;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $question = auth()->user()->questions;
        return QuestionResource::collection($question);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        $question = auth()->user()->questions()->create($request->except('apiPassword'));
        if ($question) {
            return new QuestionResource($question);
        }
        return $this->returnResponseError('E015', 'server error please try again later', 500);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = QaQuestion::findOrFail($id);
        if ($question->user_id == auth()->id()) {
            return new QuestionResource($question);
        } else {
            return $this->returnResponseError('E016' , 'Unauthorized : you view it' , 403);
        }
        return $this->returnResponseError('E017', 'server error please try again later', 500);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, $id)
    {
        $question = QaQuestion::findOrFail($id);
        if ($question->user_id == auth()->id()) {
            if ($question->update($request->except('apiPassword'))) {
                return new QuestionResource($question);
            } else {
                return $this->returnResponseError('E018', 'server error please try again later', 500);
            }
        } else {
            return $this->returnResponseError('E019', 'can\'t update this question', 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = QaQuestion::findOrFail($id);
        if(auth()->id() == $question->user_id) {
            if($question->delete()) {
                return $this->returnResponseSuccessMessages('Deleted Question Successfully');
            }  else {
                return $this->returnResponseError('E020', 'server error please try again later', 500);
            }
        } else {
            return $this->returnResponseError('E021' , 'Unauthorized : you don\'t own this question you can\'t delete it' , 403);
        }
    }
}
