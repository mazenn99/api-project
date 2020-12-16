<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['story_id' , 'user_id' , 'readed'];
    #public $timestamps = false;





    // realtions of stories
    public function stories() {
        return $this->belongsTo(Story::class , 'story_id');
    }
    // realations of user
    public function user() {
        return $this->belongsTo(User::class);
    }
}
