<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AzureAuth
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
        $userID = session('id');

        if($userID != null) {
            return view("dashboard");
        }
        return redirect("/");
    }
}
