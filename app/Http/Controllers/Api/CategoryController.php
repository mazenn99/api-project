<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->returnResponseWithData(200 , TRUE , '' , 'categories' , Category::orderBy('id' , 'DESC')->paginate($this->paginate) , 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        if(Category::create($request->all())) {
            return $this->returnResponseSuccessMessages(__('apiError.send_success', ['name' => __('general.category')]));
        }
        return $this->returnResponseError('E028' , __('apiError.server_error') , 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  Int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return new CategoryResource($category);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request,$id)
    {
        $category = Category::findOrFail($id);
        if(auth()->user()->user_level == $this->adminLevel) {
            if ($category->update($request->all())) {
                return $this->returnResponseSuccessMessages(__('apiError.success'));
            }
            return $this->returnResponseError('E029' , __('apiError.server_error') , 500);
        } else {
            return $this->returnResponseError('E010' , __('apiError.unauthorized', ['name' => __('general.category')]) , 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
