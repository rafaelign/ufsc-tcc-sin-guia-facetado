<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
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
        return $this->belongsToMany(Value::class);
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function references()
    {
        return $this->belongsToMany(Reference::class);
    }
}
