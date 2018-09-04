@extends('layouts.general')

@section('breadcrumb')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li><a href="{{ route('home') }}" aria-current="page">{{ __('Dashboard') }}</a></li>
            <li><a href="{{ route('classifications') }}" aria-current="page">{{ __('Classifications') }}</a></li>
            <li class="is-active"><a href="#" aria-current="page">{{ (int) $id > 0 ? __('Edit classification') : __('New classification') }}</a></li>
        </ul>
    </nav>
@endsection

@section('content')
    <div class="coluns">
        <div class="column is-8">
            <form id="form" action="{{ (int) $id > 0 ? route('classifications.update', ['id' => (int) $id]) : route('classifications.store') }}" method="POST">
                @if ((int) $id > 0)
                    @method('PUT')
                @endif

                @csrf

                <div class="field">
                    <label class="label">{{ __('Title') }}</label>
                    <div class="control">
                        <input name="title" class="input is-medium" type="text" placeholder="{{ __('Input title') }}" value="{{ $classification ? $classification->title : null }}">
                    </div>
                </div>

                <div class="field">
                    <label class="label">{{ __('Slug') }}</label>
                    <div class="control">
                        <input name="slug" class="input is-medium" type="text" placeholder="{{ __('Input slug') }}" value="{{ $classification ? $classification->slug : null }}">
                    </div>
                </div>

                <div class="field">
                    <label class="label">{{ __('Description') }}</label>
                    <div class="control">
                        <textarea name="description" class="textarea" placeholder="Textarea">{{ $classification ? $classification->description : null }}</textarea>
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link">{{ __('Submit') }}</button>
                    </div>
                    <div class="control">
                        <button class="button is-text">{{ __('Cancel') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

