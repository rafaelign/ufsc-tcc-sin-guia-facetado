<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntityValue extends Model
{
    protected $table = 'entities_values';

    protected $fillable = [
        'entity_id',
        'value_id',
    ];

    public function value()
    {
        return $this->belongsTo(Value::class);
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
}
