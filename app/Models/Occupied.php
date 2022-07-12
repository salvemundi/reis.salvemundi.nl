<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Occupied extends Model
{
    use HasFactory;
    use UsesUuid;

    protected $table = 'occupied';
}
