<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class qa_user_details extends Model
{
    protected $fillable = ['user_level' , 'user_id'];
    public $timestamps = false;




    // user relation
    public function user() {
        return $this->belongsTo(User::class);
    }
}
