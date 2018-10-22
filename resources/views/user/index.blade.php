@extends('layouts.general')

@section('breadcrumb')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li><a href="{{ route('home') }}" aria-current="page">{{ __('Dashboard') }}</a></li>
            <li class="is-active"><a href="#" aria-current="page">{{ __('Usuários') }}</a></li>
        </ul>
    </nav>
@endsection

@section('content')
    <h1 class="subtitle">
        <a href="{{ route('users.edit', ['id' => 0]) }}" class="button is-medium is-pulled-right">
            <span class="icon"><span class="mdi mdi-check"></span></span> <span>{{ __('Novo usuário') }}</span>
        </a>
        {{ __('Usuários') }}
    </h1>
    <table class="table is-fullwidth is-striped is-hoverable is-bordered">
        <thead>
            <tr>
                <th><abbr title="{{ __('Id') }}">#</abbr></th>
                <th>{{ __('Nome') }}</th>
                <th>{{ __('E-mail') }}</th>
                <th class="has-text-centered">{{ __('Ações') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td class="has-text-centered">
                    <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="button is-small">
                        <span class="icon"><span class="mdi mdi-pencil"></span></span>
                    </a>
                    <a class="button is-small delete-button"
                       data-target="modal" aria-haspopup="true" data-id="{{ $user->id }}"
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
                    {{ $users->links('vendor.pagination.simple-default') }}
                </td>
            </tr>
        </tfoot>
    </table>
    <div class="modal" id="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">{{ __('Delete user') }}</p>
                <button class="delete modal-cancel-x" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
                {{ __('Você tem certeza?') }}
            </section>
            <footer class="modal-card-foot">
                <button class="button is-danger modal-confirm" data-id="" @click="attemptDeleteUser()">{{ __('Remover') }}</button>
                <button class="button modal-cancel">Cancelar</button>
            </footer>
        </div>
    </div>
@endsection