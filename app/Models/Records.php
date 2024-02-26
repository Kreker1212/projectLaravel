<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Records extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function doctors (): BelongsToMany
    {
        return $this->belongsToMany(Doctor::class);
    }

    public function medicaments(): BelongsToMany
    {
        return $this->belongsToMany(Medicament::class, 'medicament_records', 'record_id', 'medicament_id');
    }
}
