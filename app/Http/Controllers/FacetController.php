<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use App\Models\Facet;
use App\Models\FacetGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FacetController extends Controller
{
    /**
     * @param int $classificationId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(int $classificationId)
    {
        return view('facet.index', [
            'classification' => Classification::find($classificationId),
            'facets' => Facet::where('classification_id', $classificationId)
                ->paginate(5),
            'classificationId' => $classificationId,
        ]);
    }

    /**
     * @param int $classificationId
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $classificationId, int $id)
    {
        return view('facet.edit', [
            'classification' => Classification::find($classificationId),
            'facet' => Facet::find($id),
            'facet_groups' => FacetGroup::orderBy('title')->pluck('title', 'id'),
            'classificationId' => $classificationId,
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
            'classification_id' => 'required',
            'facet_group_id' => 'required',
            'title' => 'required|max:100',
            'slug' => 'required|unique:entities|max:150',
            'description' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('facets.edit', ['classificationId' => (int) $request->classification_id, 'id' => 0])
                ->withErrors($validator)
                ->withInput();
        }

        $facet = new Facet();

        $facet->classification_id = $request->classification_id;
        $facet->facet_group_id = $request->facet_group_id;
        $facet->title = $request->title;
        $facet->slug = str_slug($request->slug);
        $facet->description = $request->description;
        $facet->type = $request->type;
        $facet->user_id = \Auth::user()->id;

        if ($facet->save()) {
            return redirect()
                ->route('classifications.facets', ['classificationId' => $request->classification_id]);
        }

        return redirect()
            ->route('classifications.facets', ['classificationId' => $request->classification_id])
            ->withInput();
    }

    /**
     * @param Request $request
     * @param int $classificationId
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $classificationId, int $id)
    {
        $validator = Validator::make($request->all(), [
            'facet_group_id' => 'required',
            'title' => 'required|max:100',
            'slug' => [
                'required',
                'max:150',
                Rule::unique('facets')->ignore($id, 'id')
            ],
            'description' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('facets.edit', ['classificationId' => (int) $classificationId, 'id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        $facet = Facet::find($id);

        $facet->facet_group_id = $request->facet_group_id;
        $facet->title = $request->title;
        $facet->slug = str_slug($request->slug);
        $facet->description = $request->description;
        $facet->type = $request->type;

        if ($facet->save()) {
            return redirect()
                ->route('classifications.facets', ['classificationId' => $classificationId]);
        }

        return redirect()
            ->route('facets.edit', ['classificationId' => (int) $classificationId, 'id' => $id])
            ->withInput();
    }

    public function destroy(int $classificationId, int $id)
    {
        $facet = Facet::find($id);

        if ($facet) {
            if ($facet->delete()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Faceta removida',
                ]);
            }
        }

        return response()->json([
            'error' => true,
            'message' => 'Ocorreu um erro ao remover',
        ]);
    }
}
