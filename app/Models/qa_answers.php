<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class qa_answers extends Model
{
    protected $fillable = ['description' , 'correct' , 'post_date' , 'qa_question_id' , 'user_id' , 'notify_answer' , 'notify_correct' , 'points_answer' , 'points_correct'];
    public $timestamps = false;


    // relations of question
    public function question() {
        return $this->belongsTo(QaQuestion::class , 'qa_question_id');
    }
    // relations of users
    public function user() {
        return $this->belongsTo(User::class);
    }
}
