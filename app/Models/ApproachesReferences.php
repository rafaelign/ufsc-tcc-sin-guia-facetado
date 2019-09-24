<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApproachesReferences extends Model
{
    /** @var int PUBLISHED */
    const PUBLISHED = 1;

    protected $table = 'approaches_references';

    protected $fillable = [
        'approach_id',
        'reference_id',
        'code',
    ];

}
