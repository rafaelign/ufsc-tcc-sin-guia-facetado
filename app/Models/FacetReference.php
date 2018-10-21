<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacetReference extends Model
{
    protected $table = 'facets_references';

    protected $fillable = [
        'facet_id',
        'reference_id',
        'code',
    ];

    public function reference()
    {
        return $this->belongsTo(Reference::class);
    }
}