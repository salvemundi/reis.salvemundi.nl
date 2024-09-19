<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
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
    public function boot(): void
    {
        Gate::define('viewPulse', function () {
            return $this->userIsAdmin();
        });

        try {
            view()->share(['userIsAdmin' => $this->userIsAdmin()]);
        } catch(\Exception $e) {

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
