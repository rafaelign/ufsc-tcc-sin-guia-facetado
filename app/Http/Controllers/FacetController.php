<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use App\Models\Facet;
use App\Models\FacetGroup;
use App\Models\Reference;
use App\Models\Value;
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
            toastr()->error('Informações inválidas. Verifica as informações fornecidas!');

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
            toastr()->success('Cadastro efetuado com sucesso!');

            return redirect()
                ->route('classifications.facets', ['classificationId' => $request->classification_id]);
        }

        toastr()->error('Ocorreu um problema ao gravar as informações, tente novamente mais tarde.');

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
            toastr()->error('Informações inválidas. Verifica as informações fornecidas!');

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
            toastr()->success('Atualização efetuada com sucesso!');

            return redirect()
                ->route('classifications.facets', ['classificationId' => $classificationId]);
        }

        toastr()->error('Ocorreu um problema ao gravar as informações, tente novamente mais tarde.');

        return redirect()
            ->route('facets.edit', ['classificationId' => (int) $classificationId, 'id' => $id])
            ->withInput();
    }

    /**
     * @param int $classificationId
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $classificationId, int $id)
    {
        $facet = Facet::find($id);

        if ($facet) {
            if ($facet->delete()) {
                toastr()->success('Registro removido com sucesso!');

                return response()->json([
                    'error' => false,
                    'message' => 'Faceta removida',
                ]);
            }
        }

        toastr()->error('Ocorreu um erro ao remover o registro, tente novamente mais tarde.');

        return response()->json([
            'error' => true,
            'message' => 'Ocorreu um erro ao remover',
        ]);
    }

    /**
     * @param int $classificationId
     * @param int $facetId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function values(int $classificationId, int $facetId)
    {
        return view('facet.values.index', [
            'facet' => Facet::find($facetId),
            'facetValues' => Value::where(['facet_id' => $facetId])->paginate(5),
            'classificationId' => $classificationId,
            'facetId' => $facetId,
        ]);
    }

    /**
     * @param int $classificationId
     * @param int $facetId
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editValues(int $classificationId, int $facetId, int $id)
    {
        return view('facet.values.edit', [
            'facet' => Facet::find($facetId),
            'value' => Value::find($id),
            'classificationId' => $classificationId,
            'facetId' => $facetId,
            'id' => $id,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeValue(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'classification_id' => 'required',
            'facet_id' => 'required',
            'title' => 'required|max:100',
            'slug' => 'required|unique:values|max:190',
            'value' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            toastr()->error('Informações inválidas. Verifica as informações fornecidas!');

            return redirect()
                ->route('facets.edit.values', ['classificationId' => (int) $request->classification_id, 'facetId' => (int) $request->facet_id, 'id' => 0])
                ->withErrors($validator)
                ->withInput();
        }

        $value = new Value();

        $value->facet_id = $request->facet_id;
        $value->title = $request->title;
        $value->slug = str_slug($request->slug);
        $value->value = $request->value;
        $value->description = $request->description;

        if ($value->save()) {
            toastr()->success('Cadastro efetuado com sucesso!');

            return redirect()
                ->route('facets.values', ['classificationId' => $request->classification_id, 'facetId' => $request->facet_id]);
        }

        toastr()->error('Ocorreu um problema ao gravar as informações, tente novamente mais tarde.');

        return redirect()
            ->route('facets.values', ['classificationId' => $request->classification_id, 'facetId' => $request->facet_id])
            ->withInput();
    }

    /**
     * @param Request $request
     * @param int $classificationId
     * @param int $facetId
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateValue(Request $request, int $classificationId, int $facetId, int $id)
    {
        $validator = Validator::make($request->all(), [
            'classification_id' => 'required',
            'facet_id' => 'required',
            'title' => 'required|max:100',
            'slug' => [
                'required',
                'max:150',
                Rule::unique('values')->ignore($id, 'id')
            ],
            'value' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            toastr()->error('Informações inválidas. Verifica as informações fornecidas!');

            return redirect()
                ->route('facets.edit.values', ['classificationId' => (int) $classificationId, 'facetId' => $facetId, 'id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        $value = Value::find($id);

        $value->title = $request->title;
        $value->slug = str_slug($request->slug);
        $value->value = $request->value;
        $value->description = $request->description;

        if ($value->save()) {
            toastr()->success('Atualização efetuada com sucesso!');

            return redirect()
                ->route('facets.values', ['classificationId' => $classificationId, 'facetId' => $facetId]);
        }

        toastr()->error('Ocorreu um problema ao gravar as informações, tente novamente mais tarde.');

        return redirect()
            ->route('facets.edit.values', ['classificationId' => (int) $classificationId, 'facetId' => $facetId, 'id' => $id])
            ->withInput();
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyValue(int $id)
    {
        $value = Value::find($id);

        if ($value) {
            if ($value->delete()) {
                toastr()->success('Registro removido com sucesso!');

                return response()->json([
                    'error' => false,
                    'message' => 'Valor removido com sucesso!',
                ]);
            }
        }

        toastr()->error('Ocorreu um erro ao remover o registro, tente novamente mais tarde.');

        return response()->json([
            'error' => true,
            'message' => 'Ocorreu um erro ao remover',
        ]);
    }

    /**
     * @param Request $request
     * @param int $classificationId
     * @param int $facetId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function references(Request $request, int $classificationId, int $facetId)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'facet_id' => 'required',
                'description' => 'required',
                'code' => 'required',
            ]);

            if ($validator->fails()) {
                toastr()->error('Informações inválidas. Verifica as informações fornecidas!');

                return redirect()
                    ->route('facets.references', ['classificationId' => (int) $classificationId, 'facetId' => $facetId])
                    ->withErrors($validator)
                    ->withInput();
            }

            $facet = Facet::find($facetId);

            if ($facet) {
                $reference = new Reference();
                $reference->description = $request->description;

                if ($reference->save()) {
                    toastr()->success('Cadastro efetuado com sucesso!');

                    $facet->references()->attach($reference, ['code' => $request->code]);
                }
            }

            toastr()->error('Informações inválidas. Verifica as informações fornecidas!');

            return redirect()
                ->route('facets.references', ['classificationId' => $classificationId, 'facetId' => $facetId]);
        }

        $facet = Facet::with('references')->find($facetId);

        return view('facet.references.index', [
            'facet' => $facet,
            'classificationId' => $classificationId,
            'facetId' => $facetId,
        ]);
    }

    /**
     * @param int $facetId
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function detachReference(int $facetId, int $id)
    {
        $facet = Facet::find($facetId);

        if ($facet) {
            if ($facet->references()->detach($id)) {
                toastr()->success('Registro desvinculado com sucesso!');

                return response()->json([
                    'error' => false,
                    'message' => 'Referência removida com sucesso!',
                ]);
            }
        }

        toastr()->error('Ocorreu um erro ao desvincular o registro, tente novamente mais tarde.');

        return response()->json([
            'error' => true,
            'message' => 'Ocorreu um erro ao remover referência',
        ]);
    }
}
