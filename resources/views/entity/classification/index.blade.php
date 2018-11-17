@extends('layouts.general')

@section('breadcrumb')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li><a href="{{ route('home') }}" aria-current="page">{{ __('Dashboard') }}</a></li>
            <li><a href="{{ route('classifications') }}" aria-current="page">{{ __('Classificações') }}</a></li>
            <li><a href="{{ route('entities.edit', ['classificationId' => $classificationId, 'id' => $entityId]) }}" aria-current="page">{{ $entity->title }}</a></li>
            <li class="is-active"><a href="#" aria-current="page">Referências</a></li>
        </ul>
    </nav>
@endsection

@section('content')
    <div class="columns has-background-white">
        <div class="column is-12">
            <div class="tabs is-medium">
                <ul>
                    <li>
                        <a href="{{ route('entities.edit', [
                            'classificationId' => $classificationId,
                            'id' => $entityId,
                        ]) }}"><span>Definição</span></a>
                    </li>
                    <li class="is-active">
                        <a href="#"><span>Classificação</span></a>
                    </li>
                    <li>
                        <a href="{{ route('entities.references', [
                                'classificationId' => $classificationId,
                                'id' => $entityId,
                            ]) }}"><span>Referências</span></a>
                    </li>
                </ul>
            </div>

            <form id="form" action="{{ route('entities.classification', ['classificationId' => $classificationId, 'entityId' => (int) $entityId]) }}" method="POST">
                @csrf
                <input type="hidden" name="classification_id" value="{{ $classificationId }}">
                <input type="hidden" name="entity_id" value="{{ $entityId }}">

                <div class="has-background-white">
                    @foreach($facetsGroups as $facetGroup)
                        <section class="box">
                            <p class="subtitle">{{ $facetGroup->title }}</p>
                            <hr>

                            <div class="columns is-multiline">
                                @foreach($facetGroup->facets as $facet)
                                    <div class="column is-6">
                                        <section>
                                            <b>{{ $facet->title }}</b> <hr>

                                            @foreach($facet->values as $value)
                                                <div class="field">
                                                    <div class="control">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="values[]" value="{{ $value->id }}"
                                                                @if (in_array($value->id, $entityValues)) checked @endif> {{ $value->title }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </section>
                                    </div>
                                    <div class="is-clearfix"></div>
                                @endforeach
                            </div>
                        </section>
                    @endforeach

                    <div class="is-clearfix"></div>

                    <div class="field is-grouped">
                        <div class="control">
                            <button class="button is-link">{{ __('Alterar') }}</button>
                        </div>
                        <div class="control">
                            <button class="button is-text"></button>
                            <a href="{{ route('entities.edit', ['classificationId' => $classificationId, 'id' => $entityId]) }}" class="button is-text">{{ __('Cancelar') }}</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection