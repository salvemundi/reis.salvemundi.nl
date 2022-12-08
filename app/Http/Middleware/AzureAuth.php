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
        $userId = session('id');
        $groupsObj = session('groups');

        if (!$userId || !$groupsObj) {
            return redirect("/");
        }

        $groups = array_map(fn($val) => $val->getId(), $groupsObj);

        $allowedGroups = [
            'a4aeb401-882d-4e1e-90ee-106b7fdb23cc', // ictCommissie
            'b16d93c7-42ef-412e-afb3-f6cbe487d0e0', // bestuur
            '4c027a6d-0307-4aee-b719-23d67bcd0959', // reiscommissie
        ];

        if (!array_intersect($allowedGroups, $groups)) {
            return abort(401);
        }

        return $next($request);
    }
}
