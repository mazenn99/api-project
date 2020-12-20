<?php

namespace App;

use App\Events\SendWelcomeEmailEvent;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\qa_answers;
use App\Models\qa_votes_answer;
use App\Models\QaQuestion;
use App\Models\Articles;
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
        'fullName', 'email', 'password','twitter','bio','askfm','linkedin','imgPath','facebookID','twitterID','facebook','user_university','user_specialist','user_region','agreement','user_faculity','group','created_at','updated_at','user_level'
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

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => SendWelcomeEmailEvent::class,
    ];


    // relations of articles
    public function articles() {
        return $this->hasMany(Articles::class);
    }
    // comments relations
    public function comments() {
        return $this->hasMany(Comment::class);
    }
    // favorites relations
    public function favorites() {
        return $this->hasMany(Favorite::class);
    }
    // question relation
    public function questions() {
        return $this->hasMany(QaQuestion::class);
    }
    // answer relation
    public function answers() {
        return $this->hasManyThrough(qa_answers::class , QaQuestion::class);
    }
    // relations of votes answer
    public function votesAnswer() {
        return $this->hasMany(qa_votes_answer::class);
    }
}
