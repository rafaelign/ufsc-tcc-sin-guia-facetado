<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Collection::all(['title', 'slug']));
    }

    /**
     * Get collection by slug
     *
     * @param string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCollectionBySlug(string $slug)
    {
        return response()->json(
            Collection::where('slug', '=', $slug)
                ->with('entities')
                ->first()
        );
    }

    /**
     * @param string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFacetsByCollectionSlug(string $slug)
    {
        $collection = Collection::where('slug', '=', $slug)
            ->first();

        return response()->json($collection
            ->facets()
            ->with('values')
            ->with('references')
            ->get());
    }
}
