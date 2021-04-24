<?php

namespace App\Http\Middleware;

use App\MyLog;
use Closure;

class LogsMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        MyLog::create([
            'link'=> request()->url()
        ]);
        return $next($request);
    }
}
