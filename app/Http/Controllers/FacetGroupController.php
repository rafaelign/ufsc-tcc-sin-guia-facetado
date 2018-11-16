<?php

namespace App\Http\Controllers;

use App\Models\FacetGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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

    public function index()
    {
        return view('facet_group.index', [
            'facetsGroups' => FacetGroup::paginate(5)
        ]);
    }

    public function edit(int $id)
    {
        return view('facet_group.edit', [
            'facetGroup' => FacetGroup::find($id),
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
            'title' => 'required|max:100',
            'layout' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('facets_groups.edit', ['id' => 0])
                ->withErrors($validator)
                ->withInput();
        }

        $facetGroup = new FacetGroup();

        $facetGroup->title = $request->title;
        $facetGroup->layout = $request->layout;

        if ($facetGroup->save()) {
            return redirect()
                ->route('facets_groups');
        }

        return redirect()
            ->route('facets_groups')
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
            'title' => 'required|max:100',
            'layout' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('facets_groups.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        $facetGroup = FacetGroup::find($id);

        $facetGroup->title = $request->title;
        $facetGroup->layout = $request->layout;

        if ($facetGroup->save()) {
            return redirect()
                ->route('facets_groups');
        }

        return redirect()
            ->route('facets_groups.edit', ['id' => $id])
            ->withInput();
    }
}
