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
                    {{ __('Olá') }}, {{ Auth::user()->name }}
                </h1>
                <h2 class="subtitle">
                    {{ __('Bem vindo!') }}
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
                    <p class="subtitle">{{ __('Total de acessos') }}</p>
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <p class="title">@if ($total_accesses > 0) {{ $popular_page }} @else - @endif</p>
                    <p class="subtitle">{{ __('Página mais acessada') }}</p>
                </article>
            </div>
        </div>
    </section>
@endsection
