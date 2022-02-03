<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UsesUuid;

class Blog extends Model
{
    use UsesUuid;
    // Yea I know lol \/
    protected $table = 'content';
}
