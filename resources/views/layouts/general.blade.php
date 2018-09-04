@extends('layouts.app')

@section('body-content')
    <!-- Header navbar -->
    @include('layouts.partials.header')
    <!-- EOF Header navbar -->

    <div class="container is-fluid">
        <div class="columns">
            <div class="column is-12">
                <div class="container">
                    @yield('breadcrumb')

                    @yield('message')

                    @yield('content')
                </div>
            </div>
        </div>
    </div>
@endsection