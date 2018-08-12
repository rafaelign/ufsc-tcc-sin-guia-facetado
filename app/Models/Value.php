<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    protected $table = 'values';

    protected $fillable = [
        'title',
        'slug',
        'value',
        'type',
    ];

    public function facet()
    {
        return $this->belongsTo(Facet::class);
    }
}
