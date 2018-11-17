<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\Facet;
use App\Models\FacetGroup;
use App\Models\Reference;
use App\Models\Value;
use App\Models\Classification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EntityController extends Controller
{
    /**
     * Get entity by slug
     *
     * @param string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBySlug(string $slug)
    {
        return response()->json(
            Entity::where('slug', '=', $slug)
                ->where('published', Entity::PUBLISHED)
                ->with('references')
                ->first()
        );
    }

    /**
     * @param string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function getReferencesByEntitySlug(string $slug)
    {
        $entity = Entity::where('slug', '=', $slug)
            ->where('published', Entity::PUBLISHED)
            ->first();

        $references = Reference::join('entities_references', 'entities_references.reference_id', 'references.id')
            ->where('entities_references.entity_id', $entity->id)
            ->orderBy('entities_references.code', 'ASC')
            ->groupBy('description', 'entities_references.code')
            ->get(['description', 'entities_references.code']);

        return response()->json($references);
    }

    /**
     * @param Request $request
     * @param string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByClassificationSlug(Request $request, string $slug)
    {
        $entities = Entity::join('classifications', 'classifications.id', 'entities.classification_id')
            ->where('classifications.slug', '=', $slug)
            ->where('entities.published', Entity::PUBLISHED)
            ->with('values');

        if ($request->isMethod('post')) {
            $post = json_decode(file_get_contents('php://input'));

            $mode = isset($post->mode) ? str_slug($post->mode) : 'restrict';
            $filters = isset($post->values) ? $post->values : [];

            foreach ($filters as $key => $filter) {
                if (isset($filter->value) && !$filter->value) {
                    unset($filters[$key]);
                }
            }

            if (!empty($filters)) {
                /**
                 * Para cada filtro selecionado, uma subquery é adicionada
                 * TODO: Refatorar consulta para melhorar performance
                 */
                $values = [];
                foreach ($filters as $filter) {
                    if (is_array($filter->value)) {
                        if ($mode === 'restrict') {
                            foreach ($filter->value as $value) {
                                if (!in_array($value, $values)) {
                                    $values[] = $value;
                                }
                            }
                        } else {
                            $values[] = $filter->value;
                        }
                    } else {
                        if (!in_array($filter->value, $values)) {
                            $values[] = $filter->value;
                        }
                    }
                }

                foreach ($values as $value) {
                    $entities->whereIn('entities.id', function ($query) use ($value) {
                        if (is_array($value)) {
                            $query->select('entity_id')
                                ->from('entities_values')
                                ->whereIn('value_id', $value)
                                ->groupBy('entity_id')->get();
                        } else {
                            $query->select('entity_id')
                                ->from('entities_values')
                                ->where('value_id', $value)
                                ->groupBy('entity_id')->get();
                        }
                    });
                }
            }
        }

        return response()->json(
            $entities->get([
                'entities.id',
                'entities.title',
                'entities.slug',
                'entities.short_description',
            ])
        );
    }

    /**
     * @param string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function getValuesByEntitySlug(string $slug)
    {
        $values = Value::join('entities_values', 'value_id', 'id')
            ->whereIn('entities_values.entity_id', function ($query) use ($slug) {
                $query->select('id')
                    ->from('entities')
                    ->where('slug', '=', $slug)
                    ->where('published', '=', Entity::PUBLISHED)
                    ->get(['id']);
            })
            ->get([
                'values.id',
                'values.title',
                'values.value',
                'values.description',
                'values.facet_id',
            ]);

        return response()->json($values);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function addPageView(int $id)
    {
        $entity = Entity::find($id);
        $entity->page_views = (int) $entity->page_views + 1;
        $entity->save();

        return response()->json([
            'id' => $entity->id,
            'page_views' => $entity->page_views,
        ]);
    }

    /**
     * @param int $classificationId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(int $classificationId)
    {
        return view('entity.index', [
            'classification' => Classification::find($classificationId),
            'entities' => Entity::where('classification_id', $classificationId)
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
        return view('entity.edit', [
            'classification' => Classification::find($classificationId),
            'entity' => Entity::find($id),
            'classificationId' => $classificationId,
            'id' => $id,
        ]);
    }

    /**
     * @param Request $request
     * @param int $classificationId
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function updatePublishedStatus(Request $request, int $classificationId, int $id)
    {
        $validator = Validator::make($request->all(), [
            'published' => 'required',
        ]);

        if ($validator->fails()) {
            toastr()->error('Informações inválidas. Verifica as informações fornecidas!');

            return redirect()
                ->route('classifications.entities', ['classificationId' => $classificationId])
                ->withErrors($validator)
                ->withInput();
        }

        $entity = Entity::find($id);

        if ($entity) {
            $entity->published = (int) $request->published;;

            if ($entity->save()) {
                if ((int) $request->published === 1) {
                    toastr()->success('Técnica publicada com sucesso!');
                } else {
                    toastr()->success('Técnica despublicada com sucesso!');
                }

                return response()->json([
                    'error' => false,
                    'message' => 'Técnica atualizada com sucesso!',
                ]);
            }
        }

        if ((int) $request->published === 1) {
            toastr()->error('Ocorreu um erro ao publicar a técnica, tente novamente mais tarde.');
        } else {
            toastr()->error('Ocorreu um erro ao despublicar a técnica, tente novamente mais tarde.');
        }

        return response()->json([
            'error' => true,
            'message' => 'Erro ao atualizar classificação',
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
            'title' => 'required|max:100',
            'slug' => 'required|unique:entities|max:150',
            'short_description' => 'required|max:250',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            toastr()->error('Informações inválidas. Verifica as informações fornecidas!');

            return redirect()
                ->route('entities.edit', ['classificationId' => (int) $request->classification_id, 'id' => 0])
                ->withErrors($validator)
                ->withInput();
        }

        $entity = new Entity();

        $entity->classification_id = $request->classification_id;
        $entity->title = $request->title;
        $entity->slug = str_slug($request->slug);
        $entity->short_description = $request->short_description;
        $entity->description = $request->description;
        $entity->pros = $request->pros;
        $entity->cons = $request->cons;
        $entity->images = $request->images;
        $entity->published = 0;
        $entity->page_views = 0;
        $entity->user_id = \Auth::user()->id;

        if ($entity->save()) {
            toastr()->success('Cadastro efetuado com sucesso!');

            return redirect()
                ->route('classifications.entities', ['classificationId' => $request->classification_id]);
        }

        toastr()->error('Ocorreu um problema ao gravar as informações, tente novamente mais tarde.');

        return redirect()
            ->route('classifications.entities', ['classificationId' => $request->classification_id])
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
            'title' => 'required|max:100',
            'slug' => [
                'required',
                'max:150',
                Rule::unique('entities')->ignore($id, 'id')
            ],
            'short_description' => 'required|max:250',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            toastr()->error('Informações inválidas. Verifica as informações fornecidas!');

            return redirect()
                ->route('entities.edit', ['classificationId' => (int) $classificationId, 'id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        $entity = Entity::find($id);

        $entity->title = $request->title;
        $entity->slug = str_slug($request->slug);
        $entity->short_description = $request->short_description;
        $entity->description = $request->description;
        $entity->pros = $request->pros;
        $entity->cons = $request->cons;
        $entity->images = $request->images;

        if ($entity->save()) {
            toastr()->success('Cadastro efetuado com sucesso!');

            return redirect()
                ->route('entities.edit', ['classificationId' => $classificationId, 'id' => $id]);
        }

        toastr()->error('Ocorreu um problema ao gravar as informações, tente novamente mais tarde.');

        return redirect()
            ->route('classifications.entities', ['classificationId' => $classificationId])
            ->withInput();
    }

    /**
     * @param Request $request
     * @param int $classificationId
     * @param int $entityId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function references(Request $request, int $classificationId, int $entityId)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'entity_id' => 'required',
                'description' => 'required',
                'code' => 'required',
            ]);

            if ($validator->fails()) {
                toastr()->error('Informações inválidas. Verifica as informações fornecidas!');

                return redirect()
                    ->route('entities.references', ['classificationId' => (int) $classificationId, 'entityId' => $entityId])
                    ->withErrors($validator)
                    ->withInput();
            }

            $entity = Entity::find($entityId);

            if ($entity) {
                $reference = new Reference();
                $reference->description = $request->description;

                if ($reference->save()) {
                    toastr()->success('Cadastro efetuado com sucesso!');

                    $entity->references()->attach($reference, ['code' => $request->code]);
                }
            }

            toastr()->error('Ocorreu um problema ao gravar as informações, tente novamente mais tarde.');

            return redirect()
                ->route('entities.references', ['classificationId' => $classificationId, 'entityId' => $entityId]);
        }

        $entity = Entity::with('references')->find($entityId);

        return view('entity.references.index', [
            'entity' => $entity,
            'classificationId' => $classificationId,
            'entityId' => $entityId,
        ]);
    }

    /**
     * @param int $entityId
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function detachReference(int $entityId, int $id)
    {
        $entity = Entity::find($entityId);

        if ($entity) {
            if ($entity->references()->detach($id)) {
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


    public function classification(Request $request, int $classificationId, int $entityId)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'classification_id' => 'required',
                'entity_id' => 'required',
            ]);

            if ($validator->fails()) {
                toastr()->error('Informações inválidas. Verifica as informações fornecidas!');

                return redirect()
                    ->route('entities.classification', ['classificationId' => (int) $classificationId, 'entityId' => $entityId])
                    ->withErrors($validator)
                    ->withInput();
            }

            $entity = Entity::find($entityId);

            if ($entity) {
                $values = $request->values;

                if (!empty($values)) {
                    if ($entity->values()->sync(array_values($values)) ) {
                        toastr()->success('Atualização efetuada com sucesso!');
                    }
                }
            }

            toastr()->error('Ocorreu um erro ao gravar as alterações, tente novamente mais tarde.');

            return redirect()
                ->route('entities.classification', ['classificationId' => $classificationId, 'entityId' => $entityId]);
        }

        $entity = Entity::with('values')->find($entityId);
        $entityValues = [];
        foreach ($entity->values as $v) {
            $entityValues[] = $v->id;
        }
        $facetsGroups = app("App\Http\Controllers\FacetGroupController")->getFacetGroupsByClassificationId($classificationId);

        return view('entity.classification.index', [
            'entity' => $entity,
            'entityValues' => $entityValues,
            'facetsGroups' => $facetsGroups,
            'classificationId' => $classificationId,
            'entityId' => $entityId,
        ]);
    }
}
