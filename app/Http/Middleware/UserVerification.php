<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserVerification
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
        /**
         * Super Admin
         * Super User
         * Admin
         * User
         * 
         */
        $status = "error";
        $message = "Access denied!";
        $id = Auth::user()->id;
        if(true)
        {
            return redirect()->route('users.editprofile', $id)
            ->with($status,$message);;
        }
        
        return $next($request);
    }
}
