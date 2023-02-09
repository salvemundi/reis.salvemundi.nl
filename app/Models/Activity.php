<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Activity extends Model
{
    use HasFactory, UsesUuid;
    protected $table = 'activities';
    protected $fillable = ['name','price', 'description'];

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(Participant::class);
    }
}
