<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApproachesEntities extends Model
{
    /** @var int PUBLISHED */
    const PUBLISHED = 1;

    protected $table = 'approaches_entities';

    protected $fillable = [
        'approach_id',
        'entity_id',
    ];

}
