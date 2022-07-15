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
            '516f03f9-be0a-4514-9da8-396415f59d0b', // introCommisie
            '314044d2-bafe-43c7-99f3-c8824dbcbef0', // bhv
        ];

        if (!array_intersect($allowedGroups, $groups)) {
            return abort(401);
        }

        return $next($request);
    }
}
