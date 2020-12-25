<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Models\QaQuestion;


class QuestionController extends Controller
{

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
        $question = auth()->user()->questions()->create($request->except('api_key'));
        if ($question) {
            return new QuestionResource($question);
        }
        return $this->returnResponseError('E015', __('apiError.server_error'), 500);
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
        if ($this->checkRole($question)) {
            return new QuestionResource($question);
        } else {
            return $this->returnResponseError('E016' , __('apiError.unauthorized', ['name' => __('general.question')]) , 403);
        }
        return $this->returnResponseError('E017', __('apiError.server_error'), 500);
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
        if ($this->checkRole($question)) {
            if ($question->update($request->except('api_key'))) {
                return new QuestionResource($question);
            } else {
                return $this->returnResponseError('E018', __('apiError.server_error'), 500);
            }
        } else {
            return $this->returnResponseError('E019', __('apiError.unauthorized', ['name' => __('general.question')]), 403);
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
        if($this->checkRole($question) === true) {
            if($question->delete()) {
                return $this->returnResponseSuccessMessages(__('apiError.success'));
            }  else {
                return $this->returnResponseError('E020', __('apiError.server_error'), 500);
            }
        } else {
            return $this->returnResponseError('E021' , __('apiError.unauthorized', ['name' => __('general.question')]) , 403);
        }
    }
}
