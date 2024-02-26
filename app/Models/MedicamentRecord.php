<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MedicamentRecord extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function records(): BelongsToMany
    {
        return $this->belongsToMany(Records::class);
    }

    public function medicaments(): BelongsToMany
    {
        return $this->belongsToMany(Medicament::class);
    }
}
