<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use Illuminate\Http\Request;

class EntityController extends Controller
{
    /**
     * Get entity by slug
     *
     * @param string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEntityBySlug(string $slug)
    {
        return response()->json(
            Entity::where('slug', '=', $slug)
                ->first()
        );
    }
}
