@extends('layouts.general')

@section('breadcrumb')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li><a href="{{ route('home') }}" aria-current="page">{{ __('Dashboard') }}</a></li>
            <li><a href="{{ route('classifications') }}" aria-current="page">{{ __('Classificações') }}</a></li>
            <li><a href="{{ route('facets.edit', ['classificationId' => $classificationId, 'id' => (int) $id]) }}" aria-current="page">{{ $facet->title }}</a></li>
            <li class="is-active"><a href="#" aria-current="page">Valores possíveis</a></li>
        </ul>
    </nav>
@endsection

@section('content')
    <div class="columns has-background-white">
        <div class="column is-12">
            <form id="form" action="{{ (int) $id > 0 ?
                route('facets.update.values', ['classificationId' => $classificationId, 'facetId' => $facetId, 'id' => (int) $id]) :
                route('facets.store.values', ['classificationId' => $classificationId, 'facetId' => $facetId]) }}" method="POST">
                @if ((int) $id > 0)
                    @method('PUT')
                @endif @csrf
                <input type="hidden" name="classification_id" value="{{ $classificationId }}">
                <input type="hidden" name="facet_id" value="{{ $facetId }}">
                @if ($value) <input type="hidden" name="id" value="{{ $id }}"> @endif

                <div class="tabs is-medium">
                    <ul>
                        <li>
                            <a href="{{ route('facets.edit', [
                                'classificationId' => $classificationId,
                                'id' => $facetId,
                            ]) }}"><span>Definição</span></a>
                        </li>
                        <li class="is-active">
                            <a href="#"><span>Valores possíveis</span></a>
                        </li>
                        <li>
                            <a href="{{ route('facets.references', [
                            'classificationId' => $classificationId,
                            'id' => $facetId,
                        ]) }}"><span>Referências</span></a>
                        </li>
                    </ul>
                </div>

                <div class="box help-content has-background-white">
                    <div class="field">
                        <label class="label">{{ __('Título') }}</label>
                        <div class="control">
                            <input name="title" class="input is-medium" type="text" placeholder="{{ __('Informe o título') }}" value="{{ $value ? $value->title : null }}">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">{{ __('Slug') }}</label>
                        <div class="control">
                            <input name="slug" class="input is-medium" type="text" placeholder="{{ __('Informe o slug') }}" value="{{ $value ? $value->slug : null }}">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">{{ __('Valor') }}</label>
                        <div class="control">
                            <input name="value" class="input is-medium" type="text" placeholder="{{ __('Informe o valor correspondente a esta característica') }}" value="{{ $value ? $value->value : null }}">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">{{ __('Descrição') }}</label>
                        <div class="control">
                            <textarea name="description" rows="2" class="textarea" placeholder="{{ __('Informe a descrição') }}">{{ $value ? $value->description : null }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link">{{ (int) $id > 0 ? __('Alterar') : __('Cadastrar') }}</button>
                    </div>
                    <div class="control">
                        <a href="{{ route('classifications.facets', ['classificationId' => $classificationId]) }}" class="button is-text">{{ __('Cancelar') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

