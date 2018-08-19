<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Facet;
use App\Models\FacetGroup;
use Illuminate\Http\Request;

class FacetGroupController extends Controller
{
    /**
            * @param string $slug
    * @return \Illuminate\Http\JsonResponse
        */
    public function getFacetGroupsByCollectionSlug(string $slug)
    {
        return response()->json(FacetGroup::whereIn('id', function ($query) use ($slug) {
            $query->select('facet_group_id')
                ->from('facets')
                ->join('collections', 'collections.id', 'facets.collection_id')
                ->where('collections.slug', $slug);
        })
            ->orderBy('layout')
            ->with('facets.values')
            ->get());
    }
}
