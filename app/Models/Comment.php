<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment' , 'reply_to' , 'user_id' , 'story_id' , 'readed' , 'visitor'];
    public $timestamps = false;

    // relation of user
    public function user() {
        return $this->belongsTo(User::class);
    }
    // relation of story
    public function story() {
        return $this->belongsTo(Story::class , 'story_id');
    }
}
