<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacetGroup extends Model
{
    protected $table = 'facet_groups';

    protected  $fillable = [
        'title',
    ];

    public function facets()
    {
        return $this->hasMany(Facet::class);
    }
}
