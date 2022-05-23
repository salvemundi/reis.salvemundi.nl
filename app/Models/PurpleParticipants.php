<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurpleParticipants extends Model
{
    protected $table = 'purple_participants';
    protected $fillable = ['studentNumber'];
}
