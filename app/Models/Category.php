<?php

namespace App\Models;

use App\Models\Articles;
use App\Models\QaQuestion;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name' , 'type' , 'article_id' , 'question_id'];
    public $timestamps = false;


    // relations of article
    public function articles() {
        return $this->hasMany(Articles::class , 'article_id');
    }
    // relations of question
    public function questions() {
        return $this->hasMany(QaQuestion::class , 'question_id');
    }
}
