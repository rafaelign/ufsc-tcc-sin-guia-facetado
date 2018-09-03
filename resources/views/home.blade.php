@extends('layouts.general')

@section('breadcrumb')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li class="is-active"><a href="#" aria-current="page">{{ __('Dashboard') }}</a></li>
        </ul>
    </nav>
@endsection

@section('message')
    <section class="hero is-info welcome is-small">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    {{ __('Hello') }}, {{ Auth::user()->name }}
                </h1>
                <h2 class="subtitle">
                    {{ __('Welcome to the Dashboard') }}
                </h2>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="info-tiles">
        <div class="tile is-ancestor has-text-centered">
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <p class="title">{{ $total_accesses }}</p>
                    <p class="subtitle">{{ __('Total Accesses') }}</p>
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <p class="title">{{ $popular_page }}</p>
                    <p class="subtitle">{{ __('Popular page') }}</p>
                </article>
            </div>
        </div>
    </section>
@endsection
