@extends('layouts.general')

@section('breadcrumb')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li><a href="{{ route('home') }}" aria-current="page">{{ __('Dashboard') }}</a></li>
            <li><a href="{{ route('classifications') }}" aria-current="page">{{ __('Classificações') }}</a></li>
            <li class="is-active"><a href="#" aria-current="page">{{ (int) $id > 0 ? __('Editar classificação') : __('Nova classificação') }}</a></li>
        </ul>
    </nav>
@endsection

@section('content')
    <div class="columns has-background-white">
        <div class="column is-8">
            <form id="form" action="{{ (int) $id > 0 ? route('classifications.update', ['id' => (int) $id]) : route('classifications.store') }}" method="POST">
                @if ((int) $id > 0)
                    @method('PUT')
                @endif

                @csrf

                <div class="field">
                    <label class="label">{{ __('Título') }}</label>
                    <div class="control">
                        <input name="title" class="input is-medium" type="text" placeholder="{{ __('Informe o title') }}" value="{{ $classification ? $classification->title : null }}">
                    </div>
                </div>

                <div class="field">
                    <label class="label">{{ __('Slug') }}</label>
                    <div class="control">
                        <input name="slug" class="input is-medium" type="text" placeholder="{{ __('Informe o slug') }}" value="{{ $classification ? $classification->slug : null }}">
                    </div>
                </div>

                <div class="field">
                    <label class="label">{{ __('Descrição') }}</label>
                    <div class="control">
                        <textarea name="description" class="textarea" placeholder="Textarea">{{ $classification ? $classification->description : null }}</textarea>
                    </div>
                </div>

                <div class="field">
                    <label class="label">{{ __('Tipo de classificação') }}</label>
                    <div class="control">
                        <input name="classification_type" class="input is-medium" type="text" placeholder="{{ __('Informe o tipo da classificação') }}" value="{{ $classification ? $classification->classification_type : null }}">
                    </div>
                </div>

                <div class="field">
                    <label class="label">{{ __('Título no menu') }}</label>
                    <div class="control">
                        <input name="main_menu" class="input is-medium" type="text" placeholder="{{ __('Informe o título do menu') }}" value="{{ $classification ? $classification->main_menu : null }}">
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link">{{ (int) $id > 0 ? __('Alterar') : __('Cadastrar ') }}</button>
                    </div>
                    <div class="control">
                        <a href="{{ route('classifications') }}" class="button is-text">{{ __('Cancelar') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

