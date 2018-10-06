<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $table = 'references';

    protected $fillable = [
        'description',
    ];

    public function entities()
    {
        return $this->belongsToMany(Entity::class);
    }

    public function facets()
    {
        return $this->belongsToMany(Facet::class);
    }

    public function facets_references()
    {
        return $this->hasMany(FacetsReferences::class);
    }
}
