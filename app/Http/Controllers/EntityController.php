<?php

namespace App\Http\Controllers;

use App\Models\Entity;
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
            return redirect()
                ->route('classifications.entities', ['classificationId' => $classificationId])
                ->withErrors($validator)
                ->withInput();
        }

        $entity = Entity::find($id);

        if ($entity) {
            $entity->published = (int) $request->published;;

            if ($entity->save()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Técnica atualizada com sucesso!',
                ]);
            }
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
            return redirect()
                ->route('classifications.entities', ['classificationId' => $request->classification_id]);
        }

        return redirect()
            ->route('classifications.entities', ['classificationId' => $request->classification_id])
            ->withInput();
    }

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
            return redirect()
                ->route('classifications.entities', ['classificationId' => (int) $classificationId])
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
            return redirect()
                ->route('classifications.entities', ['classificationId' => $classificationId]);
        }

        return redirect()
            ->route('classifications.entities', ['classificationId' => $classificationId])
            ->withInput();
    }
}
