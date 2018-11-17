@extends('layouts.general')

@section('breadcrumb')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li><a href="{{ route('home') }}" aria-current="page">{{ __('Dashboard') }}</a></li>
            <li><a href="{{ route('classifications') }}" aria-current="page">{{ __('Classificações') }}</a></li>
            <li><a href="{{ route('facets.edit', ['classificationId' => $classificationId, 'id' => $facetId]) }}" aria-current="page">{{ $facet->title }}</a></li>
            <li class="is-active"><a href="#" aria-current="page">Valores possíveis</a></li>
        </ul>
    </nav>
@endsection

@section('content')
    <div class="columns has-background-white">
        <div class="column is-12">
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

            <h2 class="subtitle">
                <a href="{{ route('facets.edit.values', [
                        'classificationId' => $classificationId,
                        'facetId' => $facetId,
                        'id' => 0
                    ]) }}" class="button is-medium is-pulled-right">
                    <span class="icon"><span class="mdi mdi-check"></span></span> <span>{{ __('Novo Valor') }}</span>
                </a>
                &nbsp;
            </h2>
            <table class="table is-fullwidth is-striped is-hoverable is-bordered">
                <thead>
                <tr>
                    <th style="width: 5%;"><abbr title="{{ __('Código') }}">#</abbr></th>
                    <th style="width: 20%;">{{ __('Título') }}</th>
                    <th>{{ __('Descrição') }}</th>
                    <th>{{ __('Valor') }}</th>
                    <th class="has-text-centered" style="width: 9%;">{{ __('Ações') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($facetValues as $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->title }}</td>
                        <td>{{ $value->description }}</td>
                        <td>{{ $value->value }}</td>
                        <td class="has-text-centered">
                            <a href="{{ route('facets.edit.values', [
                                'classificationId' => $classificationId,
                                'facetId' => $facetId,
                                'id' => $value->id
                            ]) }}" class="button is-small">
                                <span class="icon"><span class="mdi mdi-pencil"></span></span>
                            </a>
                            <a class="button is-small delete-button"
                               data-target="modal" aria-haspopup="true" data-id="{{ $value->id }}" data-classification=""
                               onclick="event.preventDefault();">
                                <span class="icon"><span class="mdi mdi-delete"></span></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5">
                        {{ $facetValues->links('vendor.pagination.simple-default') }}
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="modal" id="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">{{ __('Remover valor') }}</p>
                <button class="delete modal-cancel-x" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
                {{ __('Você tem certeza?') }}
            </section>
            <footer class="modal-card-foot">
                <button class="button is-danger modal-confirm" data-id="" data-classification="" @click="attemptDeleteValue()">{{ __('Remover') }}</button>
                <button class="button modal-cancel">Cancelar</button>
            </footer>
        </div>
    </div>
@endsection