<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Story extends Model
{
    protected $fillable = ['user_id' , 'environment' , 'specialize' , 'companyName' , 'requirements' ,'contactRule' ,'period' ,'description' ,'category' ,'title' ,'numLikes' ,'tags' ,'draft' ,'view_count' ,'picture'];
    protected $appends = ['photo_url'];



    // Relation of user
    public function user() {
        return $this->belongsTo(User::class);
    }

    // custom attribute return path of picture
    public function getPhotoUrlAttribute() {
        return config('app.url') . '/' . Storage::url('stories/'.$this->picture) ;
    }
}
