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
        //
    }
}
