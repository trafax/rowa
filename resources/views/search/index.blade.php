@extends('layouts.website')

@section('content')
    <div class="main container">
        <div class="top d-flex">
            <div class="breadcrumbs">
                <a href="/">Home</a> /
                Zoeken
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 category-container">
                <h2 class="category">Zoeken</h2>
                <div class="products-container">
                    @forelse ($products as $webshopProduct)
                        <div class="product fourth">
                            <div class="image" style="background-image: url('{{ asset('assets/' . $webshopProduct->assets()->first()->file) }}')">
                                <div class="overlay">
                                    <a href="{{ route('webshopProduct', $webshopProduct->slug) }}" class="stretched-link">Bekijk product</a>
                                </div>
                            </div>
                            <div class="title">{{ $webshopProduct->title }}</div>
                            <div class="price">&euro; {{ price($webshopProduct->price) }}</div>
                        </div>
                    @empty
                        <p>Geen zoekresultaten gevonden.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
