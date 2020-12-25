<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VotesRequest;
use App\Models\Qa_votes;
use Illuminate\Http\Request;

class VotesController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VotesRequest $request)
    {
        $vote = Qa_votes::create([
            'qa_question_id' => $request->input('question_id'),
            'qa_answer_id'   => $request->input('answer_id'),
            'user_id'        => auth()->id(),
            'vote_code_down' => $request->input('vote_code_down') ?? 0,
            'vote_code_up'   => $request->input('vote_code_up') ?? 0,
        ]);
        return $this->returnResponseSuccessMessages(__('apiError.send_success', ['name' => __('general.vote')]));
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
        $vote = Qa_votes::findOrFail($id);
        if($this->checkRole($vote) === true) {
            if($vote->delete()) {
                return $this->returnResponseSuccessMessages(__('apiError.delete_success', ['name' => __('general.vote')]));
            }  else {
                return $this->returnResponseError('E026', __('apiError.server_error'), 500);
            }
        } else {
            return $this->returnResponseError('E027' , __('apiError.unauthorized', ['name' => __('general.vote')]) , 403);
        }
    }
}
