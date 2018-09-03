@extends('layouts.general')

@section('breadcrumb')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li><a href="{{ route('home') }}" aria-current="page">{{ __('Dashboard') }}</a></li>
            <li class="is-active"><a href="#" aria-current="page">{{ __('Users') }}</a></li>
        </ul>
    </nav>
@endsection

@section('content')

@endsection