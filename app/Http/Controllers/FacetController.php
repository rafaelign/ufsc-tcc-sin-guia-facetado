<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use App\Models\Facet;

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
                ->paginate(5)
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
            'id' => $id,
        ]);
    }
}
