<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;
    use UsesUuid;

    protected $table = 'payments';

    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class);
    }
}
