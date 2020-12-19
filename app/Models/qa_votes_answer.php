<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class qa_votes_answer extends Model
{
    protected $fillable = ['qa_answer' , 'user_id' , 'vote_code_up' , 'created_at' , 'updated_at'];



    // relations of answer

}
