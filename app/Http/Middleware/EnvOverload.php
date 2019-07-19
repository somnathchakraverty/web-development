<?php

namespace App\Http\Middleware;

use Closure;
use Dotenv\Dotenv;

class EnvOverload
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $environment = app('env');
        if (\File::exists(base_path('app/Env') . "/" . $environment . ".env")) {
            $env = new Dotenv(base_path('app/Env'), $environment . ".env");
            $env->load();
            $env->overload();
        }
        $response = $next($request);
        
        return $response;
    }

}
