<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\QaVotesAnswerRequest;
use App\Http\Requests\VotesRequest;
use App\Models\qa_votes_answer;
use Illuminate\Http\Request;

class QaVotesAnswerController extends Controller
{
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QaVotesAnswerRequest $request)
    {
        if(qa_votes_answer::create([
            'qa_answer_id'   => $request->input('answer_id'),
            'user_id'        => auth()->id(),
            'vote_code_up'   => $request->input('vote_code_up'),
            'vote_code_down' => $request->input('vote_code_down')
        ])) {
            return $this->returnResponseSuccessMessages(__('apiError.send_success', ['name' => __('general.vote')]));
        }
        return $this->returnResponseError('E028' , __('apiError.server_error') , 500);
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
        $qaVotesAnswer = qa_votes_answer::findOrFail($id);
        if($this->checkRole($qaVotesAnswer) === true) {
            if($qaVotesAnswer->delete()) {
                return $this->returnResponseSuccessMessages(__('apiError.delete_success', ['name' => __('general.vote')]));
            }  else {
                return $this->returnResponseError('E024' , __('apiError.server_error') ,500);
            }
        } else {
            return $this->returnResponseError('E025' , __('apiError.unauthorized', ['name' => __('general.vote')]) , 403);
        }
    }
}
