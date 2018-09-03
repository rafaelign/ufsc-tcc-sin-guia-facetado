@extends('layouts.login')

@section('content')
    <div class="column is-4 is-offset-4">
        <h3 class="title has-text-grey">{{ __('Reset Password') }}</h3>
        <p class="subtitle has-text-grey">{{ __('Please inform your email.') }}</p>
        <div class="box">
            <figure class="avatar">
                <img src="{{ asset('images/login-avatar.png')  }}">
            </figure>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                @csrf
                <div class="field">
                    <div class="control">
                        <input id="email" type="email" class="input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('Your Email') }}" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <button class="button is-block is-info is-large is-fullwidth">{{ __('Send Password Reset Link') }}</button>
            </form>
        </div>
    </div>
@endsection