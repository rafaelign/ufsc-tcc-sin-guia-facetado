@extends('layouts.general')

@section('breadcrumb')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li><a href="{{ route('home') }}" aria-current="page">{{ __('Dashboard') }}</a></li>
            <li><a href="{{ route('classifications') }}" aria-current="page">{{ __('Classificações') }}</a></li>
            <li class="is-active"><a href="#" aria-current="page">{{ $classification->title }}</a></li>
            <li class="is-active"><a href="#" aria-current="page">{{ (int) $id > 0 ? __('Editar faceta') : __('Nova faceta') }}</a></li>
        </ul>
    </nav>
@endsection

@section('content')
    <div class="columns has-background-white">
        <div class="column is-12">
            <form id="form" action="{{ (int) $id > 0 ? route('facets.update', ['id' => (int) $id]) : route('facets.store') }}" method="POST">
                @if ((int) $id > 0)
                    @method('PUT')
                @endif @csrf

                <div class="tabs is-centered is-boxed is-medium">
                    <ul>
                        <li class="is-active">
                            <a @click="facetastab='default'"><span>Definição</span></a>
                        </li>
                        <li>
                            <a @click="facetastab='valores'"><span>Valores possíveis</span></a>
                        </li>
                        <li>
                            <a @click="facetastab='referencias'"><span>Referências</span></a>
                        </li>
                    </ul>
                </div>

                <div class="box help-content has-background-white">
                    <div v-if="facetastab === 'default'">
                        <div class="field">
                            <label class="label">{{ __('Título') }}</label>
                            <div class="control">
                                <input name="title" class="input is-medium" type="text" placeholder="{{ __('Informe o título') }}" value="{{ $facet ? $facet->title : null }}">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">{{ __('Slug') }}</label>
                            <div class="control">
                                <input name="slug" class="input is-medium" type="text" placeholder="{{ __('Informe o slug') }}" value="{{ $facet ? $facet->slug : null }}">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">{{ __('Descrição') }}</label>
                            <div class="control">
                                <textarea name="description" rows="2" class="textarea" placeholder="{{ __('Informe a descrição') }}">{{ $facet ? $facet->description : null }}</textarea>
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <input name="slug" class="input is-medium" type="text" placeholder="{{ __('Informe o tipo') }}" value="{{ $facet ? $facet->type : null }}">
                            </div>
                        </div>


                        <div class="field">
                            <label class="label">{{ __('Tipo') }}</label>
                            <div class="control">
                                <div class="select is-info">
                                    <select name="type">
                                        <option>Selecione umtipo</option>
                                        <option>Switch</option>
                                        <option>Slider</option>
                                        <option>Checkbox</option>
                                        <option>Checkbutton</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- title, slug, description, type, values, references --}}

                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link">{{ (int) $id > 0 ? __('Alterar') : __('Cadastrar') }}</button>
                    </div>
                    <div class="control">
                        <button class="button is-text">{{ __('Cancelar') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

