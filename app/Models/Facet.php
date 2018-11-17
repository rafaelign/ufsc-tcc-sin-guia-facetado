<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facet extends Model
{
    protected $table = 'facets';

    protected  $fillable = [
        'title',
        'slug',
        'description',
        'type',
    ];

    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }

    public function references()
    {
        return $this->belongsToMany(Reference::class, 'facets_references', 'facet_id')->withPivot('code');
    }

    public function values()
    {
        return $this->hasMany(Value::class);
    }

    public function group()
    {
        return $this->belongsTo(FacetGroup::class, 'facet_group_id', 'id');
    }
}
