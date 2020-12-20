<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class qa_votes_answer extends Model
{
    protected $fillable = ['qa_answer_id' , 'user_id' , 'vote_code_up' , 'created_at' , 'updated_at'];



    // relations of answer
    public function answer() {
        return $this->belongsTo(qa_answers::class , 'qa_answer_id');
    }
}
