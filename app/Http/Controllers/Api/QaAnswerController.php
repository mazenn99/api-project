<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\qaAnswers;
use App\Http\Resources\AnswerResource;
use App\Models\qa_answers;


class QaAnswerController extends Controller
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
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(qaAnswers $request)
    {
        $answer = qa_answers::create([
            'description'       => $request->input('description'),
            'correct'           => $request->input('correct') ?? 0,
            'qa_question_id'    => $request->input('qa_question_id'),
            'user_id'           => auth()->id(),
            'notify_answer'     => $request->input('notify_answer') ?? 0,
            'notify_correct'    => $request->input('notify_correct') ?? 0,
            'points_answer'     => $request->input('points_answer') ?? 20,
            'points_correct'    => $request->input('points_correct') ?? 50,
        ]);
        return new AnswerResource($answer);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $answer = qa_answers::findOrFail($id);
        if($this->checkRole($answer)) {
            return new AnswerResource($answer);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(qaAnswers $request, $id)
    {
        $answer = qa_answers::findOrFail($id);
        if($this->checkRole($answer)) {
            $answer->update([
                'description'       => $request->input('description')       ,
                'correct'           => $request->input('correct')           ,
                'notify_answer'     => $request->input('notify_answer')     ,
                'notify_correct'    => $request->input('notify_correct')    ,
                'points_answer'     => $request->input('points_answer')     ,
                'points_correct'    => $request->input('points_correct')    ,
            ]);
            return new AnswerResource($answer);
        } else {
            return $this->returnResponseError('E023' , 'Unauthorized : you don\'t own this answer' , 403);
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
        $answer = qa_answers::findOrFail($id);
        if($this->checkRole($answer)) {
            if($answer->delete()) {
                return $this->returnResponseSuccessMessages(__('apiError.delete_success', ['name' => __('general.answer')]));
             }  else {
                return $this->returnResponseError('E024' , __('apiError.server_error') ,500);
            }
        } else {
            return $this->returnResponseError('E025' , __('apiError.unauthorized', ['name' => __('general.answer')]) , 403);
        }
    }
}
