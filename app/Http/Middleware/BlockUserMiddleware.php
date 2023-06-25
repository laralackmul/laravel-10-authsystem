<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
    public function handle(Request $request, Closure $next): Response
    {
        $myIp = $request->ip();
        if(cache()->has($myIp))
        {
            $block_time_in_sec = cache()->get($myIp);
            $block_time_in_min = (int)$block_time_in_sec / 60;
            $message = "Your IP is blocked for ". $block_time_in_min." minutes";
            return redirect()->route('block.ip')->with('error', $message);
        }
        
        return $next($request);
    }
}
