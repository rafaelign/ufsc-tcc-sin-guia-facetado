    @extends('layouts.general')

@section('breadcrumb')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li><a href="{{ route('home') }}" aria-current="page">{{ __('Dashboard') }}</a></li>
            <li class="is-active"><a href="#" aria-current="page">{{ __('Classificações') }}</a></li>
        </ul>
    </nav>
@endsection

@section('content')
    <h2 class="subtitle">
        <a href="{{ route('classifications.edit', ['id' => 0]) }}" class="button is-medium is-pulled-right">
            <span class="icon"><span class="mdi mdi-check"></span></span> <span>{{ __('Nova classificação') }}</span>
        </a>

        {{ __('Classificações') }}
    </h2>
    <section class="info-tiles">
        @forelse ($classifications as $classification)
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">{{ $classification->title }}</p>
                </header>
                <div class="card-content">
                    <div class="content">
                        {{ $classification->description }}
                    </div>
                </div>
                <footer class="card-footer">
                    <a href="{{ route('classifications.edit', ['id' => $classification->id]) }}" class="card-footer-item">
                        <span class="icon"><span class="mdi mdi-pencil"></span></span> {{ __('Editar') }}
                    </a>
                    <a href="#" class="card-footer-item">
                        <span class="icon"><span class="mdi mdi-application"></span></span> <span class="badge is-badge-info" data-badge="{{ count($classification->entities) }}">{{ __('Técnicas') }}</span>
                    </a>
                    <a href="#" class="card-footer-item">
                        <span class="icon"><span class="mdi mdi-adjust"></span></span> <span class="badge is-badge-info" data-badge="{{ count($classification->facets) }}">{{ __('Facetas') }}</span>
                    </a>
                    <a href="#" @click="updatePublish({{ $classification->id }})" class="card-footer-item">
                        <span class="icon" v-if="isLoading()"><span class="mdi mdi-spin mdi-loading"></span></span>
                        @if ($classification->published)
                            <span class="icon" v-if="! isLoading()"><span class="mdi mdi-arrow-expand-down"></span></span> {{ __('Despublicar') }}
                        @else
                            <span class="icon" v-if="! isLoading()"><span class="mdi mdi-arrow-expand-up is-success"></span></span> {{ __('Publicar') }}
                        @endif
                    </a>
                </footer>
            </div>
        @empty
            <div class="notification is-info">{{ __('Nenhuma classificação encontrada.') }}</div>
        @endforelse
    </section>
@endsection