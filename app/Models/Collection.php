<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $table = 'collections';

    protected $fillable = [
        'title',
        'slug',
    ];

    public function facets()
    {
        return $this->hasMany(Facet::class);
    }

    public function entities()
    {
        return $this->hasMany(Entity::class);
    }
}
