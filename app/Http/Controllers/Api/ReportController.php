<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;
use App\Models\Report_us;
use http\Env\Request;

class ReportController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReportRequest $request)
    {
        $request['user_id'] = auth()->id();
        Report_us::create($request->only('article_id' , 'user_id' , 'description'));
        return $this->returnResponseSuccessMessages(__('apiError.send_success', ['name' => __('general.report')]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $report = Report_us::findOrFail($id);
        if($report->user_id == auth()->id()) {
            if($report->delete()) {
                return $this->returnResponseSuccessMessages(__('apiError.delete_success', ['name' => __('general.report')]));
            } else {
                return $this->returnResponseError('E012' , __('apiError.server_error') , 500);
            }
        } else {
            return $this->returnResponseError('E013' , __('apiError.unauthorized', ['name' => __('general.report')]) , 403);
        }
    }
}
