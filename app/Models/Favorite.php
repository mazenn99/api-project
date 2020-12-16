<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['story_id' , 'user_id' , 'readed'];
    public $timestamps = false;
}
