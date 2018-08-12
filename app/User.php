<?php

namespace App;

use App\Models\Entity;
use App\Models\Facet;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function entities()
    {
        return $this->hasMany(Entity::class);
    }

    public function facets()
    {
        return $this->hasMany(Facet::class);
    }
}
