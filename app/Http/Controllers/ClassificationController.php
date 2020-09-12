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

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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
            'classification_type' => 'required|max:150',
            'main_menu' => 'required|max:150',
        ]);

        if ($validator->fails()) {
            toastr()->error('Informações inválidas. Verifica as informações fornecidas!');

            return redirect()
                ->route('classifications.edit', ['id' => 0])
                ->withErrors($validator)
                ->withInput();
        }

        $classification = new Classification;

        $classification->title = $request->title;
        $classification->slug = str_slug($request->slug);
        $classification->description = $request->description;
        $classification->classification_type = $request->classification_type;
        $classification->main_menu = $request->main_menu;

        if ($classification->save()) {
            toastr()->success('Cadastro efetuado com sucesso!');

            return redirect()
                ->route('classifications');
        }

        toastr()->error('Ocorreu um problema ao gravar as informações, tente novamente mais tarde.');

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
            ],
            'classification_type' => 'required|max:150',
            'main_menu' => 'required|max:150',
        ]);

        if ($validator->fails()) {
            toastr()->error('Informações inválidas. Verifica as informações fornecidas!');

            return redirect()
                ->route('classifications.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        $classification = Classification::find($id);

        $classification->title = $request->title;
        $classification->slug = $request->slug;
        $classification->description = $request->description;
        $classification->classification_type = $request->classification_type;
        $classification->main_menu = $request->main_menu;

        if ($classification->save()) {
            toastr()->success('Atualização efetuada com sucesso!');

            return redirect()
                ->route('classifications');
        }

        toastr()->error('Ocorreu um problema ao gravar as informações, tente novamente mais tarde.');

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
     * Get classification slug by id
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getClassificationSlugById(int $id)
    {

        $classification = Classification::find($id);

        return response()->json($classification);
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

    /**
     * @param string $slug
     * @return \Illuminate\Http\JsonResponse
     */
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
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function updatePublishedStatus(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'published' => 'required',
        ]);

        if ($validator->fails()) {
            toastr()->error('Informações inválidas. Verifica as informações fornecidas!');

            return redirect()
                ->route('classifications.edit', ['id' => 0])
                ->withErrors($validator)
                ->withInput();
        }

        $classification = Classification::find($id);

        if ($classification) {
            $classification->published = (int) $request->published;

            if ($classification->save()) {
                if ((int) $request->published === 1) {
                    toastr()->success('Classificação publicada com sucesso!');
                } else {
                    toastr()->success('Classificação despublicada com sucesso!');
                }

                return response()->json([
                    'error' => false,
                    'message' => 'Classificação atualizada com sucesso!',
                ]);
            }
        }

        if ((int) $request->published === 1) {
            toastr()->error('Ocorreu um erro ao publicar a classificação, tente novamente mais tarde.');
        } else {
            toastr()->error('Ocorreu um erro ao despublicar a classificação, tente novamente mais tarde.');
        }

        return response()->json([
            'error' => true,
            'message' => 'Erro ao atualizar classificação',
        ]);
    }
}
