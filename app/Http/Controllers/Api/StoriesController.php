<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoryRequest;
use App\Http\Resources\StoriesResource;
use App\Models\Story;
use App\Traits\apiTraitFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoriesController extends Controller
{
    use apiTraitFunction;
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
        return StoriesResource::collection(Story::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $img = $request->file('picture')->hashName();
        $upload = $request->file('picture')->storeAs('public/stories/', $img);
        if($upload) {
            $story = auth()->user()->stories()->create([
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
                return new StoriesResource($story);
            } else {
                return $this->returnResponseError('E007' , 'sorry error please try again later' , 500);
            }
        } else {
            return $this->returnResponseError('E008' , 'sorry can\'t upload photo please try again' , 500);
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
        $story = Story::findOrFail($id);
        return new StoriesResource($story);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoryRequest $request, $id)
    {
        $story = Story::findOrFail($id);
        $img = NULL;
        if(auth()->id() == $story->user_id) {
            if($request->file('picture')) {
                $img = $request->file('picture')->hashName();
                $upload = $request->file('picture')->storeAs('public/stories/', $img);
                Storage::delete('public/stories/'.$story->picture);
            }
            $story->update([
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
                'picture' => $img ? $img : $story->picture
            ]);
            return new StoriesResource($story);
        } else {
            return $this->returnResponseError('E008' , 'Unauthorized : you don\'t own this story' , 403);
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
        $story = Story::findOrFail($id);
        if(auth()->id() == $story->user_id) {
            if($story->delete()) {
                $story->delete();
                return $this->returnResponseSuccessMessages('Deleted Story Successfully');
            }  else {
                return $this->returnResponseError('E009' , 'error not deleted please try again later' ,500);
            }
        } else {
            return $this->returnResponseError('E010' , 'Unauthorized : you don\'t own this story you can\'t delete it' , 403);
        }
    }
}
