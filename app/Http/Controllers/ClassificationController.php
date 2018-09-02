<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use Illuminate\Http\Request;

class ClassificationController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Classification::all(['title', 'slug']));
    }

    /**
     * Get collection by slug
     *
     * @param string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function getClassificationBySlug(string $slug)
    {
        return response()->json(
            Classification::where('slug', '=', $slug)
                ->with('entities')
                ->first()
        );
    }

    /**
     * @param string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFacetsByClassificationSlug(string $slug)
    {
        $collection = Classification::where('slug', '=', $slug)
            ->first();

        return response()->json($collection
            ->facets()
            ->with('values')
            ->with('references')
            ->get());
    }
}
