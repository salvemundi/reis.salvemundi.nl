<?php

namespace Database\Seeders;

use App\Http\Controllers\AuthController;
use App\Models\User;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Microsoft\Graph\Exception\GraphException;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

class fetchUsers extends Seeder
{
    private AuthController $authController;

    public function __construct()
    {
        $this->authController = new AuthController();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $graph = $this->authController->connectToAzure();
        $users = $this->fetchUsers($graph);

        foreach($users as $user) {
            if(User::find($user->getId()) === null) {
                $newUser = new User();
                $newUser->id = $user->getId();
                $newUser->save();
            }
        }
    }

    private function fetchUsers(Graph $graph)
    {
        try {
            return $graph->createRequest("GET", '/users/?$top=900')
                ->setReturnType(Model\User::class)
                ->execute();
        } catch (GraphException|GuzzleException $exception) {
            Log::error('Connection to Azure failed!');
            return null;
        }
    }
}
