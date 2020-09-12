<?php

namespace App\Http\Controllers;

use App\Models\Approach;
use App\Models\Entity;
use App\Models\Reference;
use Illuminate\Http\Request;


class ApproachController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return response()->json(Approach::get(['id','approach_title', 'slug', 'short_description'])
        );
        
    }
    public function getApproachBySlug(string $slug)
    {

        return response()->json(
            Approach::where('slug', '=', $slug)
            ->where('published', 1)
            ->get(['approach_title', 'slug', 'approach_description', 'context_title','context_description'])
            ->first()
        );
        
    }
    public function getReferencesByApproachSlug(string $slug)
    {
        $approach = Approach::where('slug', '=', $slug)
            ->where('published', Approach::PUBLISHED)
            ->first();

        $references = Reference::join('approaches_references', 'approaches_references.reference_id', 'references.id')
            ->where('approaches_references.approach_id', $approach->id)
            ->orderBy('approaches_references.code', 'ASC')
            ->groupBy('description', 'approaches_references.code')
            ->get(['description', 'approaches_references.code']);

        return response()->json($references);
    }
    public function getEntitiesByApproachSlug(string $slug)
    {

        $entities = Approach::join('approaches_entities', 'approaches.id', '=', 'approaches_entities.approach_id')
        ->join('entities', 'entities.id', '=', 'approaches_entities.entity_id')
        ->join('classifications', 'classifications.id', '=', 'entities.classification_id' )
        ->where('approaches.slug', '=', $slug)
        ->where('entities.published', Entity::PUBLISHED)
        ->get(['entities.title', 'entities.slug', 'entities.short_description', 'classifications.slug as classification_slug']);

        return response()->json($entities);
    }


}
