@extends('layouts.general')

@section('breadcrumb')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li><a href="{{ route('home') }}" aria-current="page">{{ __('Dashboard') }}</a></li>
            <li><a href="{{ route('classifications') }}" aria-current="page">{{ __('Classificações') }}</a></li>
            <li class="is-active"><a href="#" aria-current="page">{{ $classification->title }}</a></li>
            <li class="is-active"><a href="#" aria-current="page">{{ (int) $id > 0 ? __('Editar faceta') : __('Nova faceta') }}</a></li>
        </ul>
    </nav>
@endsection

@section('content')
    <div class="columns has-background-white">
        <div class="column is-12">
            <form id="form" action="{{ (int) $id > 0 ?
                route('facets.update', ['classificationId' => $classificationId, 'id' => (int) $id]) :
                route('facets.store', ['classificationId' => $classificationId]) }}" method="POST">
                @if ((int) $id > 0)
                    @method('PUT')
                @endif @csrf
                <input type="hidden" name="classification_id" value="{{ $classificationId }}">
                @if ($facet) <input type="hidden" name="id" value="{{ $id }}"> @endif

                <div class="tabs is-medium">
                    <ul>
                        <li class="is-active">
                            <a href="#"><span>Definição</span></a>
                        </li>
                        @if ($facet)
                            <li>
                                <a href="{{ route('facets.values', [
                                'classificationId' => $classificationId,
                                'id' => $id,
                            ]) }}"><span>Valores possíveis</span></a>
                            </li>
                            <li>
                                <a href="{{ route('facets.references', [
                                'classificationId' => $classificationId,
                                'id' => $id,
                            ]) }}"><span>Referências</span></a>
                            </li>
                        @endif
                    </ul>
                </div>

                <div class="box help-content has-background-white">
                    <div v-if="facetastab === 'default'">
                        <div class="field">
                            <label class="label">{{ __('Título') }}</label>
                            <div class="control">
                                <input name="title" class="input is-medium" type="text" placeholder="{{ __('Informe o título') }}" value="{{ $facet ? $facet->title : null }}">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">{{ __('Slug') }}</label>
                            <div class="control">
                                <input name="slug" class="input is-medium" type="text" placeholder="{{ __('Informe o slug') }}" value="{{ $facet ? $facet->slug : null }}">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">{{ __('Descrição') }}</label>
                            <div class="control">
                                <textarea name="description" rows="2" class="textarea" placeholder="{{ __('Informe a descrição') }}">{{ $facet ? $facet->description : null }}</textarea>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">{{ __('Grupo') }} <a href="{{ route('facets_groups') }}" class="button is-small"><span class="icon"><span class="mdi mdi-pencil"></span></span> <span>Gerenciar</span></a></label>
                            <div class="control">
                                <div class="select is-info">
                                    <select name="facet_group_id">
                                        <option>{{ __('Selecione um grupo') }}</option>
                                        @foreach($facet_groups as $groupId => $group)
                                            <option value="{{ $groupId }}" @if ($facet && $groupId === $facet->facet_group_id) selected @endif>{{ $group }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">{{ __('Tipo') }}</label>
                            <div class="control">
                                <div class="select is-info">
                                    <select name="type">
                                        <option>Selecione um tipo</option>
                                        <option @if ($facet && $facet->type === 'select') selected @endif value="select">Lista</option>
                                        <option @if ($facet && $facet->type === 'switch') selected @endif value="switch">Switch</option>
                                        <option @if ($facet && $facet->type === 'slider') selected @endif value="slider">Slider</option>
                                        <option @if ($facet && $facet->type === 'checkbox') selected @endif value="checkbox">Checkbox</option>
                                        <option @if ($facet && $facet->type === 'checkbutton') selected @endif value="checkbutton">Checkbutton</option>
                                    </select>
                                </div>
                            </div>
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

