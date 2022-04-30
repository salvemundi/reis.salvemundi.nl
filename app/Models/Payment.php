<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    use UsesUuid;

    protected $table = 'payments';

    public function participant() {
        return $this->belongsTo(Participant::class, 'id','participant','participants');
    }
}
