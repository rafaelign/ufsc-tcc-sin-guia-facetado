<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    protected $table = 'classifications';

    protected $fillable = [
        'title',
        'slug',
    ];

    public function facets()
    {
        return $this->hasMany(Facet::class);
    }

    public function entities()
    {
        return $this->hasMany(Entity::class)->where('published', 1);
    }
}