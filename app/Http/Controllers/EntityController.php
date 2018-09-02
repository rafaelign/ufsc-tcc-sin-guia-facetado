<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\FacetGroup;
use App\Models\Value;
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
                ->with('references')
                ->first()
        );
    }

    /**
     * @param string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByClassificationSlug(Request $request, string $slug)
    {
        $entities = Entity::join('classifications', 'classifications.id', 'entities.classification_id')
            ->where('classifications.slug', '=', $slug)
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

    /**
     * @param string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function getValuesByEntitySlug(string $slug)
    {
        $values = Value::join('entities_values', 'value_id', 'id')
            ->whereIn('entities_values.entity_id', function ($query) use ($slug) {
                $query->select('id')
                    ->from('entities')
                    ->where('slug', '=', $slug)
                    ->where('published', '=', Entity::PUBLISHED)
                    ->get(['id']);
            })
            ->get([
                'values.id',
                'values.title',
                'values.value',
                'values.description',
                'values.facet_id',
            ]);

        return response()->json($values);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function addPageView(int $id)
    {
        $entity = Entity::find($id);
        $entity->page_views = (int) $entity->page_views + 1;
        $entity->save();

        return response()->json([
            'id' => $entity->id,
            'page_views' => $entity->page_views,
        ]);
    }
}
