<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionSearchRequest;
use App\Models\Articles;
use App\Models\QaQuestion;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function QuestionSearch(QuestionSearchRequest $request) {
        $search = QaQuestion::where('title' , 'like' , '%'.$request->input('title').'%')->get();
        return $search;
    }

    public function ArticleSearch(Request $request) {
        $search = Articles::where('title' , 'like' , '%'.$request->input('title').'%')->get();
        return $search;
    }

}
