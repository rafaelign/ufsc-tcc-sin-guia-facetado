@extends('layouts.general')

@section('breadcrumb')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li><a href="{{ route('home') }}" aria-current="page">{{ __('Dashboard') }}</a></li>
            <li><a href="{{ route('users') }}" aria-current="page">{{ __('Usuários') }}</a></li>
            <li class="is-active"><a href="#" aria-current="page">{{ (int) $id > 0 ? __('Editar usuário') : __('Novo usuário') }}</a></li>
        </ul>
    </nav>
@endsection

@section('content')
    <div class="columns has-background-white">
        <div class="column is-8">
            <form id="form" action="{{ (int) $id > 0 ? route('users.update', ['id' => (int) $id]) : route('users.store') }}" method="POST">
                @if ((int) $id > 0)
                    @method('PUT')
                @endif
                @csrf
                <div class="field">
                    <label class="label">{{ __('Nome') }}</label>
                    <div class="control">
                        <input name="name" class="input is-medium" type="text" placeholder="{{ __('Informe o nome') }}" value="{{ $user ? $user->name : null }}">
                    </div>
                </div>

                <div class="field">
                    <label class="label">{{ __('E-mail') }}</label>
                    <div class="control">
                        <input name="email" class="input is-medium" type="email" placeholder="{{ __('Informe o e-mail') }}" value="{{ $user ? $user->email : null }}">
                    </div>
                </div>

                @if ((int) $id === 0)
                <div class="field">
                    <label class="label">{{ __('Senha') }}</label>
                    <div class="control">
                        <input name="password" class="input is-medium" type="password" placeholder="{{ __('Informe a senha') }}">
                    </div>
                </div>
                @endif

                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link">{{ (int) $id > 0 ? __('Alterar') : __('Cadastrar') }}</button>
                    </div>
                    <div class="control">
                        <button class="button is-text">{{ __('Cancelar') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

