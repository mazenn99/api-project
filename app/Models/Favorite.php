<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['article_id' , 'user_id' , 'readed'];
    public $timestamps = false;





    // realtions of article
    public function article() {
        return $this->belongsTo(Articles::class);
    }
    // realations of user
    public function user() {
        return $this->belongsTo(User::class);
    }
}
