@extends('layouts.general')

@section('breadcrumb')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li><a href="{{ route('home') }}" aria-current="page">{{ __('Dashboard') }}</a></li>
            <li class="is-active"><a href="#" aria-current="page">Agrupamento de facetas</a></li>
        </ul>
    </nav>
@endsection

@section('content')
    <h2 class="subtitle">
        <a href="{{ route('facets_groups.edit', [
            'id' => 0
        ]) }}" class="button is-medium is-pulled-right">
            <span class="icon"><span class="mdi mdi-check"></span></span> <span>{{ __('Novo Grupo') }}</span>
        </a>

        Grupos de facetas
    </h2>
    <table class="table is-fullwidth is-striped is-hoverable is-bordered">
        <thead>
        <tr>
            <th style="width: 5%;"><abbr title="{{ __('Código') }}">#</abbr></th>
            <th style="width: 20%;">{{ __('Título') }}</th>
            <th>{{ __('Layout') }}</th>
            <th class="has-text-centered" style="width: 9%;">{{ __('Ações') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($facetsGroups as $facetGroup)
            <tr>
                <td>{{ $facetGroup->id }}</td>
                <td>{{ $facetGroup->title }}</td>
                <td>{{ $facetGroup->layout }}</td>
                <td class="has-text-centered">
                    <a href="{{ route('facets_groups.edit', [
                        'id' => $facetGroup->id
                    ]) }}" class="button is-small">
                        <span class="icon"><span class="mdi mdi-pencil"></span></span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="4">
                {{ $facetsGroups->links('vendor.pagination.simple-default') }}
            </td>
        </tr>
        </tfoot>
    </table>
@endsection