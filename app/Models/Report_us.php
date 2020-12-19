<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report_us extends Model
{
    protected $table = 'report_us';
    protected $fillable = ['article_id' , 'user_id' , 'description'];
}
