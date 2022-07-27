<?php

namespace App\Models;

use App\Exceptions\userNotLoggedIn;
use App\Http\Controllers\AuthController;
use App\Http\Traits\UsesUuid;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Microsoft\Graph\Exception\GraphException;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;


class User extends Authenticatable
{
    use HasFactory, Notifiable, UsesUuid;

    private Graph $graph;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $authController = new AuthController();
        $this->graph = $authController->connectToAzure();
    }

    protected $table = "users";

    public function auditLogs(): HasMany
    {
        return $this->hasMany(AuditLog::class,'userId','id');
    }

    /**
     * @throws GraphException
     * @throws GuzzleException
     */
    public function getDisplayName(): ?string
    {
        $graphUser = $this->getGraphUser();
        return $graphUser->getDisplayName();
    }

    /**
     * @throws GuzzleException
     * @throws GraphException
     */
    private function getGraphUser(): Model\User {
        return $this->graph->createRequest('GET', '/user/' . $this->id)
            ->setReturnType(Model\User::class)
            ->execute();
    }

    private function userIsLoggedIn(): bool
    {
        if(null !== session('id')) {
            return true;
        } else {
            return false;
        }
    }

}
