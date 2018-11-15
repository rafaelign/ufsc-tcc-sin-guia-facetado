@extends('layouts.general')

@section('breadcrumb')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li><a href="{{ route('home') }}" aria-current="page">{{ __('Dashboard') }}</a></li>
            <li><a href="{{ route('classifications') }}" aria-current="page">{{ __('Classificações') }}</a></li>
            <li class="is-active"><a href="#" aria-current="page">{{ $classification->title }}</a></li>
            <li class="is-active"><a href="#" aria-current="page">{{ $classification->classification_type }}</a></li>
        </ul>
    </nav>
@endsection

@section('content')
    <h2 class="subtitle">
        <a href="{{ route('entities.edit', [
            'classificationId' => $classification->id,
            'id' => 0
        ]) }}" class="button is-medium is-pulled-right">
            <span class="icon"><span class="mdi mdi-check"></span></span> <span>{{ __('Nova Técnica') }}</span>
        </a>

        {{ $classification->classification_type }}
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
        @foreach ($entities as $entity)
            <tr>
                <td>{{ $entity->id }}</td>
                <td>{{ $entity->title }}</td>
                <td>{{ $entity->short_description }}</td>
                <td class="has-text-centered">
                    <a href="{{ route('entities.edit', [
                        'classificationId' => $entity->classification_id,
                        'id' => $entity->id
                    ]) }}" class="button is-small">
                        <span class="icon"><span class="mdi mdi-pencil"></span></span>
                    </a>
                    @if ($entity->published)
                        <a href="#" @click="unpublishEntity({{ $entity->classification_id }}, {{ $entity->id }})" class="button is-small">
                            <span class="icon" v-if="isLoading()"><span class="mdi mdi-spin mdi-loading"></span></span>
                            <span class="icon" v-if="! isLoading()"><span class="mdi mdi-arrow-expand-down"></span></span>
                        </a>
                    @else
                        <a href="#" @click="publishEntity({{ $entity->classification_id }}, {{ $entity->id }})" class="button is-small">
                            <span class="icon" v-if="isLoading()"><span class="mdi mdi-spin mdi-loading"></span></span>
                            <span class="icon" v-if="! isLoading()"><span class="mdi mdi-arrow-expand-up is-success"></span></span>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="4">
                {{ $entities->links('vendor.pagination.simple-default') }}
            </td>
        </tr>
        </tfoot>
    </table>
@endsection