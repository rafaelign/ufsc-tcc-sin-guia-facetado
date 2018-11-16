@extends('layouts.general')

@section('breadcrumb')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li><a href="{{ route('home') }}" aria-current="page">{{ __('Dashboard') }}</a></li>
            <li><a href="{{ route('facets_groups') }}" aria-current="page">{{ __('Grupos de facetas') }}</a></li>
            <li class="is-active"><a href="#" aria-current="page">{{ (int) $id > 0 ? __('Editar grupo') : __('Novo grupo') }}</a></li>
        </ul>
    </nav>
@endsection

@section('content')
    <div class="columns has-background-white">
        <div class="column is-12">
            <form id="form" action="{{ (int) $id > 0 ?
                route('facets_groups.update', ['id' => (int) $id]) :
                route('facets_groups.store') }}" method="POST">
                @if ((int) $id > 0)
                    @method('PUT')
                @endif @csrf
                @if ($facetGroup) <input type="hidden" name="id" value="{{ $id }}"> @endif

                <div class="tabs is-medium">
                    <ul>
                        <li class="is-active">
                            <a href="#"><span>Definição</span></a>
                        </li>
                    </ul>
                </div>

                <div class="box help-content has-background-white">
                    <div class="field">
                        <label class="label">{{ __('Título') }}</label>
                        <div class="control">
                            <input name="title" class="input is-medium" type="text" placeholder="{{ __('Informe o título') }}" value="{{ $facetGroup ? $facetGroup->title : null }}">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">{{ __('Layout') }}</label>
                        <div class="control">
                            <div class="select is-info">
                                <select name="layout">
                                    <option>Selecione um tipo de layout</option>
                                    <option @if ($facetGroup && $facetGroup->type === 'horizontal') selected @endif value="horizontal">Horizontal</option>
                                    <option @if ($facetGroup && $facetGroup->type === 'vertical') selected @endif value="vertical">Vertical</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link">{{ (int) $id > 0 ? __('Alterar') : __('Cadastrar') }}</button>
                    </div>
                    <div class="control">
                        <a href="{{ route('facets_groups') }}" class="button is-text">{{ __('Cancelar') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

