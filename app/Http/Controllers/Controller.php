<?php

namespace App\Http\Controllers;

use App\Traits\apiTraitFunction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    // this admin level
    protected $adminLevel = 1;
	// pagination count 
	protected $paginate = 10;
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, apiTraitFunction;
}
