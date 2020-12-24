<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\ArticlesResource;
use App\Models\Articles;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api')->except('index' , 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ArticlesResource::collection(Articles::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $img = $request->file('picture')->hashName();
        $upload = $request->file('picture')->storeAs('public/article/', $img);
        if($upload) {
            $story = auth()->user()->articles()->create([
                'environment'   => $request->input('environment'),
                'specialize'    => $request->input('specialize'),
                'companyName'   => $request->input('companyName'),
                'requirements'  => $request->input('requirements'),
                'contactRule'   => $request->input('contactRule'),
                'period'        => $request->input('period'),
                'description'   => $request->input('description'),
                'category'      => $request->input('category'),
                'title'         => $request->input('title'),
                'tags'          => $request->input('tags'),
                'view_count'    => 0,
                'picture'       => $img,
            ]);
            if($story) {
                return new ArticlesResource($story);
            } else {
                return $this->returnResponseError('E007' , __('apiError.server_error') , 500);
            }
        } else {
            return $this->returnResponseError('E008' , __('apiError.upload_error') , 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $story = Articles::findOrFail($id);
        return new ArticlesResource($story);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $article = Articles::findOrFail($id);
        $img = NULL;
        if($this->checkRole($article) === true) {
            if($request->file('picture')) {
                $img = $request->file('picture')->hashName();
                $upload = $request->file('picture')->storeAs('public/article/', $img);
                Storage::delete('public/article/'.$article->picture);
            }
            $article->update([
                'environment' => $request->input('environment'),
                'specialize'  => $request->input('specialize'),
                'companyName' => $request->input('companyName'),
                'requirements' => $request->input('requirements'),
                'contactRule' => $request->input('contactRule'),
                'period' => $request->input('period'),
                'description' => $request->input('description'),
                'category' => $request->input('category'),
                'title' => $request->input('title'),
                'tags'  => $request->input('tags'),
                'picture' => $img ? $img : $article->picture
            ]);
            return new ArticlesResource($article);
        } else {
            return $this->returnResponseError('E008' , __('apiError.unauthorized', ['name' => __('general.article')]) , 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Articles::findOrFail($id);
        if($this->checkRole($article) === true) {
            if($article->delete()) {
                return $this->returnResponseSuccessMessages(__('apiError.delete_success', ['name' => __('general.article')]));
            }  else {
                return $this->returnResponseError('E009' , __('apiError.server_error') ,500);
            }
        } else {
            return $this->returnResponseError('E010' , __('apiError.unauthorized', ['name' => __('general.article')]) , 403);
        }
    }
}
