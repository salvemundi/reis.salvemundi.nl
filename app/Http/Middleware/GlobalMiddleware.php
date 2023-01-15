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
            view()->share(['userIsAdmin' => $this->userIsAdmin()]);
        } catch(\Exception $e) {

        }
        return $next($request);
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
            'b16d93c7-42ef-412e-afb3-f6cbe487d0e0', // bestuur
            'a4aeb401-882d-4e1e-90ee-106b7fdb23cc', // ict-commissie
            '4c027a6d-0307-4aee-b719-23d67bcd0959', // reiscommisie
        ];

        if (!array_intersect($allowedGroups, $groups)) {
            return false;
        }

        return true;
    }
}
