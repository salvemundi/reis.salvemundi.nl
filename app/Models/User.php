<?php

namespace App\Models;

use App\Http\Controllers\AuthController;
use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Microsoft\Graph\Graph;


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

    private function userIsLoggedIn(): bool
    {
        if(null !== session('id')) {
            return true;
        } else {
            return false;
        }
    }

}
