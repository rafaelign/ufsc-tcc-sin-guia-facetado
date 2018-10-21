<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use App\Models\FacetReference;
use App\Models\Reference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
                ->get(['title', 'slug', 'classification_type', 'main_menu'])
            );
        }

        return view('classification.index', [
            'classifications' => Classification::all()
        ]);
    }

    public function edit(int $id)
    {
        $classification = Classification::find($id);

        return view('classification.edit', [
            'classification' => $classification,
            'id' => $id,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:50',
            'slug' => 'required|unique:classifications|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('classifications.edit', ['id' => 0])
                ->withErrors($validator)
                ->withInput();
        }

        $classification = new Classification;

        $classification->title = $request->title;
        $classification->slug = $request->slug;
        $classification->description = $request->description;

        if ($classification->save()) {
            return redirect()
                ->route('classifications');
        }

        return redirect()
            ->route('classifications.edit', ['id' => 0])
            ->withInput();
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:50',
            'slug' => [
                'required',
                'max:50',
                Rule::unique('classifications')->ignore($id, 'id')
            ]
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('classifications.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        $classification = Classification::find($id);

        $classification->title = $request->title;
        $classification->slug = $request->slug;
        $classification->description = $request->description;

        if ($classification->save()) {
            return redirect()
                ->route('classifications');
        }

        return redirect()
            ->route('classifications.edit', ['id' => $id])
            ->withInput();
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
            ->get() : [];

        return response()->json($facets);
    }

    public function getFacetsReferencesByClassificationSlug(string $slug)
    {
        $collection = Classification::where('slug', '=', $slug)
            ->where('published', 1)
            ->first();

        $facets = $collection ? $collection
            ->facets()
            ->get(['id']) : [];

        $references = Reference::join('facets_references', 'facets_references.reference_id', 'references.id')
            ->where(function ($query) use ($facets) {
                $query->whereIn('id', FacetReference::whereIn('facet_id', $facets)
                    ->get(['reference_id']));
            })->orderBy('facets_references.code', 'ASC')
            ->groupBy('description', 'facets_references.code')
            ->get(['description', 'facets_references.code']);

        return response()->json($references);
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
