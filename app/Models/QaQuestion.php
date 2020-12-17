<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class QaQuestion extends Model
{
    protected $table = 'qa_questions';
    protected $fillable = ['user_id' , 'title' , 'description' , 'tags' , 'closed' , 'category' , 'points' , 'last_update'];
    public $timestamps = false;




    // user relation
    public function user() {
        return $this->belongsTo(User::class);
    }
    // question relation
    public function answer() {
        return $this->hasOne(qa_answers::class , 'qa_question_id');
    }
}
