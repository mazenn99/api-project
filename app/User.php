<?php

namespace App;

use App\Models\Comment;
use App\Models\Favorite;
use App\Models\qa_user_details;
use App\Models\QaQuestion;
use App\Models\Story;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable , HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullName', 'email', 'password','twitter','bio','askfm','linkedin','imgPath','facebookID','twitterID','facebook','user_university','user_specialist','user_region','agreement','user_faculity','group','created_at','updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // relations of story
    public function stories() {
        return $this->hasMany(Story::class);
    }
    // comments relations
    public function comments() {
        return $this->hasMany(Comment::class);
    }
    // favorites relations
    public function favorites() {
        return $this->hasMany(Favorite::class);
    }
    // user level relation
    public function level() {
        return $this->hasOne(qa_user_details::class);
    }
    // question relation
    public function questions() {
        return $this->hasMany(QaQuestion::class);
    }
}
