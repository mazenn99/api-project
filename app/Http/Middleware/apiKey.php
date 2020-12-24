<?php

namespace App\Http\Middleware;

use App\Traits\apiTraitFunction;
use Closure;

class apiKey
{
    use apiTraitFunction;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->header('api_key') != env('API_KEY','Vnj4ZLHtCXaDEFXuFy0UDH9vGlc4h')) {
            return $this->returnResponseError('E001' , 'Unauthorized Access' , 401);
        }
        return $next($request);
    }
}
