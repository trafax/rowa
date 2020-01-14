@extends('layouts.website')

@section('content')
    <div class="main container">
        <div class="top d-flex">
            <div class="breadcrumbs">
                <a href="/">Home</a> /
                @if ($webshopCategory->parent)
                    <a href="{{ route('webshopCategory', $webshopCategory->parent->slug) }}">{{ $webshopCategory->parent->title }}</a> /
                @endif
                {{ $webshopCategory->title }}
            </div>
            <div class="filter ml-auto">
                <select class="form-control form-control-sm">
                    <option>Sorteer op</option>
                    <option>Prijs laag - hoog</option>
                    <option>Prijs hoog - laag</option>
                    <option>Alfabetisch</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h2 class="category">FILTER</h2>
                <hr>
            </div>
            <div class="col-md-9 category-container">
                <h2 class="category">{{ $webshopCategory->title }}</h2>
                <div class="description">{!! $webshopCategory->description !!}</div>
                <div class="products">
                    HIER KOMEN DE PRODUCTEN
                </div>
            </div>
        </div>
    </div>
@endsection
