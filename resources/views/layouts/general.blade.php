@extends('layouts.app')

@section('body-content')
    <!-- Header navbar -->
    @include('layouts.partials.header')
    <!-- EOF Header navbar -->

    <div class="container is-fluid">
        <div class="columns">
            <div class="column is-12">
                @yield('breadcrumb')

                @yield('message')

                @yield('content')
            </div>
        </div>
    </div>
@endsection