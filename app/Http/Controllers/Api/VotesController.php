<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VotesRequest;
use App\Models\Qa_votes;
use App\Traits\apiTraitFunction;
use Illuminate\Http\Request;

class VotesController extends Controller
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
        return 'hi';
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
        return $this->returnResponseSuccessMessages('successfully created votes');
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
        if(auth()->id() == $vote->user_id) {
            if($vote->delete()) {
                return $this->returnResponseSuccessMessages('Deleted vote Successfully');
            }  else {
                return $this->returnResponseError('E026', 'server error please try again later', 500);
            }
        } else {
            return $this->returnResponseError('E027' , 'Unauthorized : you don\'t own this vote you can\'t delete it' , 403);
        }
    }
}
