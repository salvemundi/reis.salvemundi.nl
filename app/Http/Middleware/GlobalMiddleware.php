<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GlobalMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            view()->share(['userIsParent' => $this->userIsParent(),'userIsAdmin' => $this->userIsAdmin()]);
        } catch(\Exception $e) {

        }
        return $next($request);
    }

    private function userIsParent(): bool
    {
        if(null !== session('id')) {
            return true;
        } else {
            return false;
        }
    }
    private function userIsAdmin(): bool
    {
        $userId = session('id');

        $groupsObj = session('groups');

        if (!$userId || !$groupsObj) {
            return false;
        }

        $groups = array_map(fn($val) => $val->getId(), $groupsObj);

        $allowedGroups = [
            'a4aeb401-882d-4e1e-90ee-106b7fdb23cc', // ictCommissie
            '516f03f9-be0a-4514-9da8-396415f59d0b', // introCommisie
            '314044d2-bafe-43c7-99f3-c8824dbcbef0', // bhv
        ];

        if (!array_intersect($allowedGroups, $groups)) {
            return false;
        }

        return true;
    }
}
