<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Articles extends Model
{
    protected $fillable = ['user_id' , 'environment' , 'specialize' , 'companyName' , 'requirements' ,'contactRule' ,'period' ,'description' ,'category' ,'title' ,'numLikes' ,'tags' ,'draft' ,'view_count' ,'picture'];
    protected $appends = ['photo_url'];



    // Relation of user
    public function user() {
        return $this->belongsTo(User::class);
    }
    // Relation of comment
    public function comments() {
        return $this->hasMany(Comment::class , 'article_id');
    }

    // custom attribute return path of picture
    public function getPhotoUrlAttribute() {
        return config('app.url') . '/' . Storage::url('article/'.$this->picture) ;
    }

    // relations of categories
    public function cateogries() {
        return $this->belongsTo(Category::class , 'article_id');
    }
}
