<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class  Doctor extends Authenticatable implements AuthenticatableContract
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'doctors';
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'records', 'user_id', 'id');
    }
}
