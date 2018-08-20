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
    public function getBySlug(string $slug)
    {
        return response()->json(
            Entity::where('slug', '=', $slug)
                ->where('published', 1)
                ->first()
        );
    }

    /**
     * @param string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByCollectionSlug(Request $request, string $slug)
    {
        $entities = Entity::join('collections', 'collections.id', 'entities.collection_id')
            ->where('collections.slug', '=', $slug)
            ->where('entities.published', 1)
            ->with('values');

        if ($request->isMethod('post')) {
            $filters = json_decode(file_get_contents('php://input'));

            if (!empty($filters)) {
                $entities->whereIn('entities.id', function ($query) use ($filters) {
                    $query->select('entity_id')
                        ->from('entities_values');

                    foreach ($filters as $filter) {
                        if (is_array($filter->value)) {
                            $query->whereIn('value_id', $filter->value);
                        } else {
                            $query->where('value_id', $filter->value);
                        }
                    }

                    $query->groupBy('entity_id')->get();
                });
            }
        }

        return response()->json($entities->get([
                'entities.id',
                'entities.title',
                'entities.slug',
                'entities.short_description',
            ]));
    }
}
