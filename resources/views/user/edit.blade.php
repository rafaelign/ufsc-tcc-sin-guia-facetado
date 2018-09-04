@extends('layouts.general')

@section('breadcrumb')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li><a href="{{ route('home') }}" aria-current="page">{{ __('Dashboard') }}</a></li>
            <li><a href="{{ route('users') }}" aria-current="page">{{ __('Users') }}</a></li>
            <li class="is-active"><a href="#" aria-current="page">{{ (int) $id > 0 ? __('Edit user') : __('New user') }}</a></li>
        </ul>
    </nav>
@endsection

@section('content')
    <div class="coluns">
        <div class="column is-8">
            <form id="form" action="{{ (int) $id > 0 ? route('users.update', ['id' => (int) $id]) : route('users.store') }}" method="{{ (int) $id > 0 ? 'PUT' : 'POST' }}">
                @csrf
                <div class="field">
                    <label class="label">{{ __('Name') }}</label>
                    <div class="control">
                        <input name="name" class="input is-medium" type="text" placeholder="{{ __('Input name') }}" value="{{ $user ? $user->name : null }}">
                    </div>
                </div>

                <div class="field">
                    <label class="label">{{ __('E-mail') }}</label>
                    <div class="control">
                        <input name="email" class="input is-medium" type="email" placeholder="{{ __('Input e-mail') }}" value="{{ $user ? $user->email : null }}">
                    </div>
                </div>

                @if ((int) $id === 0)
                <div class="field">
                    <label class="label">{{ __('Password') }}</label>
                    <div class="control">
                        <input name="password" class="input is-medium" type="password" placeholder="{{ __('Input password') }}">
                    </div>
                </div>
                @endif

                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link">Submit</button>
                    </div>
                    <div class="control">
                        <button class="button is-text">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

