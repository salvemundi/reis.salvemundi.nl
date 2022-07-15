<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            view()->share(['userIsParent' => $this->userIsParent(),'userIsAdmin' => $this->userIsAdmin()]);
        } catch(\Exception $e) {

        }
    }

    private function userIsParent() {
        if(null !== session('id')) {
            return true;
        } else {
            return false;
        }
    }
    private function userIsAdmin() {
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
            return false;
        }

        return true;
    }
}
