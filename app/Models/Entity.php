<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    /** @var int PUBLISHED */
    const PUBLISHED = 1;

    protected $table = 'entities';

    protected $fillable = [
        'title',
        'short_description',
        'description',
        'pros',
        'cons',
        'additional_data',
        'published',
    ];

    public function values()
    {
        return $this->belongsToMany(Value::class, 'entities_values', 'entity_id');
    }

    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function references()
    {
        return $this->belongsToMany(Reference::class, 'entities_references', 'entity_id');
    }
}
