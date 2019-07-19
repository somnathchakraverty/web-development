<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Auth\Middleware\Authenticate;

class AuthMiddleware extends Authenticate
{
    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $routename = $request->route()->getName();
        $this->authenticate($guards);
        $token_id = auth()->user()->id;
        if(session()->has('auth_'.$token_id)){
            $user_info = session()->get('auth_'.$token_id);
            if($routename == 'profile-info' || $routename == 'update-profile' || $routename == 'logout')
                    return $next($request);
            elseif(newSignupValidation($user_info))
                return redirect('profile-info');
            
        }
        return $next($request);
    }
}
