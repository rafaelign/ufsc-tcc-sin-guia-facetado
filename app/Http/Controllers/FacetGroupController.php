<?php

namespace App\Http\Controllers;

use App\Models\FacetGroup;
use Illuminate\Http\Request;

class FacetGroupController extends Controller
{
    /**
            * @param string $slug
    * @return \Illuminate\Http\JsonResponse
        */
    public function getFacetGroupsByClassificationSlug(string $slug)
    {
        return response()->json(FacetGroup::whereIn('id', function ($query) use ($slug) {
            $query->select('facet_group_id')
                ->from('facets')
                ->join('classifications', 'classifications.id', 'facets.classification_id')
                ->where('classifications.slug', $slug);
        })
            ->orderBy('layout')
            ->with('facets.values')
            ->get());
    }
}
