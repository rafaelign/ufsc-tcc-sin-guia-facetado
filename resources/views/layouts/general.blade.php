@extends('layouts.app')

@section('body-content')
    <!-- Header navbar -->
    @include('layouts.partials.header')
    <!-- EOF Header navbar -->

    <div class="container">
        <div class="columns">
            <div class="column is-3">
                @include('layouts.partials.sidebar')
            </div>
            <div class="column is-9">
                @yield('breadcrumb')

                @yield('message')

                @yield('content')
            </div>
        </div>
    </div>
@endsection