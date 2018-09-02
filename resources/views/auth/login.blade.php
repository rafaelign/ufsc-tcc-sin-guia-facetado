@extends('layouts.login')

@section('content')
<div class="column is-4 is-offset-4">
    <h3 class="title has-text-grey">{{ __('Login') }}</h3>
    <p class="subtitle has-text-grey">{{ __('Please login to proceed.') }}</p>
    <div class="box">
        <figure class="avatar">
            <img src="{{ asset('images/login-avatar.png')  }}">
        </figure>
        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
            @csrf
            <div class="field">
                <div class="control">
                    <input id="email" type="email" class="input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('Your Email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <input id="password" type="password" class="input{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Your Password') }}" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="field">
                <label class="checkbox">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                </label>
            </div>
            <button class="button is-block is-info is-large is-fullwidth">{{ __('Login') }}</button>
        </form>
    </div>
    <p class="has-text-grey">
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
    </p>
</div>
@endsection
