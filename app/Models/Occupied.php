<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UsesUuid;

class Occupied extends Model
{
    use HasFactory;

    protected $table = 'occupied';
}
