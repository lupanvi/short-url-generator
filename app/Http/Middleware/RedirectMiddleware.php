<?php

namespace App\Http\Middleware;

use App\Models\Url;
use Closure;
use Illuminate\Http\Request;

class RedirectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {     
        
        $url = Url::where('short_url', $request->fullUrl())->first();        
        
        if ($url) {             
            return response()->redirectTo($url->original_url);    
        }

        return $next($request);
        
    }
}
