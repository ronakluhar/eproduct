<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use Redirect;
use Session;

class AuthenticateUser
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    
    public function handle($request, Closure $next)
    {

        if (Auth::guard('user')->user())
        {

        }
        else
        {
            if ($request->ajax())
            {
                return response('Unauthorized.', 401);
            }
            else
            {
                return redirect('/login');
            }
        }


        return $next($request);
    }
}