<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Approach extends Model
{
    /** @var int PUBLISHED */
    const PUBLISHED = 1;

    protected $table = 'approaches';

    protected $fillable = [
        'id',
        'approach_title',
        'slug',
        'short_description',
        'approach_description',
        'context_title',
        'context_description',
        'published',
    ];

    public function references()
    {
        return $this->belongsToMany(Reference::class, 'approaches_references', 'approach_id')->withPivot('code');
    }

    public function entities()
    {
        return $this->belongsToMany(Entity::class, 'approaches_entities', 'approach_id');
    }
}
