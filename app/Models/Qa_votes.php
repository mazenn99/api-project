<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Qa_votes extends Model
{
    protected $fillable = ['qa_question_id' , 'qa_answer_id' , 'user_id' , 'vote_code_down' , 'vote_code_up'];


    // relation question
    public function question() {
        return $this->belongsTo(QaQuestion::class , 'qa_question_id');
    }
    // relation user
    public function user() {
        return $this->belongsTo(User::class);
    }
    // relation answer
    public function answer() {
        return $this->belongsTo(qa_answers::class);
    }
}
