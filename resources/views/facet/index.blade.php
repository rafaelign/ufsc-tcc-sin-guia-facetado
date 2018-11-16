@extends('layouts.general')

@section('breadcrumb')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li><a href="{{ route('home') }}" aria-current="page">{{ __('Dashboard') }}</a></li>
            <li><a href="{{ route('classifications') }}" aria-current="page">{{ __('Classificações') }}</a></li>
            <li class="is-active"><a href="#" aria-current="page">{{ $classification->title }}</a></li>
            <li class="is-active"><a href="#" aria-current="page">Facetas de Classificação</a></li>
        </ul>
    </nav>
@endsection

@section('content')
    <h2 class="subtitle">
        <a href="{{ route('facets.edit', [
            'classificationId' => $classification->id,
            'id' => 0
        ]) }}" class="button is-medium is-pulled-right">
            <span class="icon"><span class="mdi mdi-check"></span></span> <span>{{ __('Nova Faceta') }}</span>
        </a>

        Facetas de classificação
    </h2>
    <table class="table is-fullwidth is-striped is-hoverable is-bordered">
        <thead>
        <tr>
            <th style="width: 5%;"><abbr title="{{ __('Código') }}">#</abbr></th>
            <th style="width: 20%;">{{ __('Título') }}</th>
            <th>{{ __('Descrição') }}</th>
            <th class="has-text-centered" style="width: 9%;">{{ __('Ações') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($facets as $facet)
            <tr>
                <td>{{ $facet->id }}</td>
                <td>{{ $facet->title }}</td>
                <td>{{ $facet->description }}</td>
                <td class="has-text-centered">
                    <a href="{{ route('facets.edit', [
                        'classificationId' => $facet->classification_id,
                        'id' => $facet->id
                    ]) }}" class="button is-small">
                        <span class="icon"><span class="mdi mdi-pencil"></span></span>
                    </a>
                    <a class="button is-small delete-button"
                       data-target="modal" aria-haspopup="true" data-id="{{ $facet->id }}" data-classification="{{ $facet->classification_id }}"
                       onclick="event.preventDefault();">
                        <span class="icon"><span class="mdi mdi-delete"></span></span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="4">
                {{ $facets->links('vendor.pagination.simple-default') }}
            </td>
        </tr>
        </tfoot>
    </table>
    <div class="modal" id="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">{{ __('Remover faceta') }}</p>
                <button class="delete modal-cancel-x" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
                {{ __('Você tem certeza?') }}
            </section>
            <footer class="modal-card-foot">
                <button class="button is-danger modal-confirm" data-id="" data-classification="" @click="attemptDeleteFacet()">{{ __('Remover') }}</button>
                <button class="button modal-cancel">Cancelar</button>
            </footer>
        </div>
    </div>
@endsection