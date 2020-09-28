<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Userid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Overrides the user_id parameter 
        $user_id = $request->user()->id;
        $request->merge([
            'user_id' => $user_id
        ]);

        return $next($request);
    }
}
