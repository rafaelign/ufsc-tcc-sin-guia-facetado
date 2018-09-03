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
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(Classification::where('published', 1)
                ->get(['title', 'slug'])
            );
        }

        return view('classification.index', [
            'classifications' => Classification::all()
        ]);
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
                ->where('published', 1)
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
            ->where('published', 1)
            ->first();

        $facets = $collection ? $collection
            ->facets()
            ->with('values')
            ->with('references')
            ->get() : [];

        return response()->json($facets);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePublishedStatus(int $id)
    {
        $classification = Classification::find($id);

        if ($classification) {
            $classification->published = $classification->published ? 0 : 1;

            if ($classification->save()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Classification updated successful',
                ]);
            }
        }

        return response()->json([
            'error' => true,
            'message' => 'Classification update error',
        ]);
    }
}
