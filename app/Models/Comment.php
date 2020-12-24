<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment' , 'reply_to' , 'user_id' , 'article_id' , 'readed' , 'visitor'];
    public $timestamps = false;

    // relation of user
    public function user() {
        return $this->belongsTo(User::class);
    }
    // relation of Article
    public function article() {
        return $this->belongsTo(Articles::class , 'story_id');
    }
}
