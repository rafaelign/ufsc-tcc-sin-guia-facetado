<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntitiesReferences extends Model
{
    protected $table = 'entities_references';

    protected $fillable = [
        'entity_id',
        'reference_id',
        'code',
    ];

    public function reference()
    {
        return $this->belongsTo(Reference::class);
    }
}