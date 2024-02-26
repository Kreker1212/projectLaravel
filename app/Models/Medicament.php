<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Medicament extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function records(): BelongsToMany
    {
        return $this->belongsToMany(Records::class, 'medicament_records', 'medicament_id', 'record_id');
    }
}
