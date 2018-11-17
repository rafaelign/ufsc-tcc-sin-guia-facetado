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
                    <li>
                        <a href="{{ route('entities.classification', [
                                'classificationId' => $classificationId,
                                'id' => $entityId,
                            ]) }}"><span>Classificação</span></a>
                    </li>
                    <li class="is-active">
                        <a href="#"><span>Referências</span></a>
                    </li>
                </ul>
            </div>

            <form id="form" action="{{ route('entities.references', ['classificationId' => $classificationId, 'entityId' => (int) $entityId]) }}" method="POST">
                @csrf
                <input type="hidden" name="classification_id" value="{{ $classificationId }}">
                <input type="hidden" name="entity_id" value="{{ $entityId }}">

                <div class="help-content has-background-white">
                    <div class="columns">
                        <div class="column is-2">
                            <div class="control">
                                <label class="label">{{ __('Código') }}</label>
                                <input name="code" class="input" type="text" placeholder="Informe a código da referência">
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <div class="control is-expanded">
                                    <label class="label">{{ __('Referência') }}</label>
                                    <textarea name="description" rows="1" class="textarea" placeholder="{{ __('Informe a descrição da referência') }}"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="column is-1">
                            <div class="field">
                                <div class="control">
                                    <label class="label">&nbsp;</label>
                                    <button class="button is-link">{{ __('Cadastrar') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <hr>

            <table class="table is-fullwidth is-striped is-hoverable is-bordered">
                <thead>
                <tr>
                    <th style="width: 5%;"><abbr title="{{ __('Código') }}">#</abbr></th>
                    <th>{{ __('Descrição') }}</th>
                    <th class="has-text-centered" style="width: 9%;">{{ __('Ações') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($entity->references as $reference)
                    <tr>
                        <td>{{ $reference->pivot->code }}</td>
                        <td>{{ $reference->description }}</td>
                        <td class="has-text-centered">
                            <a class="button is-small delete-button"
                               data-target="modal" aria-haspopup="true" data-id="{{ $reference->id }}" data-classification="{{ $entityId }}"
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
                        @if (count($entity->references) <= 0) Nenhuma referência associada a esta técnica @endif
                        &nbsp;
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
                <button class="button is-danger modal-confirm" data-id="" data-classification="" @click="attemptDetachEntityReference()">{{ __('Remover') }}</button>
                <button class="button modal-cancel">Cancelar</button>
            </footer>
        </div>
    </div>
@endsection