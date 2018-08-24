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

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    public function references()
    {
        return $this->belongsToMany(Reference::class);
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
