@extends('layouts.website')

@section('content')
    <div class="main container mb-4">
        <div class="top d-flex">
            <div class="breadcrumbs">
                <a href="/">Home</a> /
                Mijn producten
            </div>
        </div>
        <div class="row">
            <div class="col">
               @include('users.partials.sidebar')
            </div>
            <div class="col-md-9 category-container">
                <div class="products-container">
                    @foreach ($products as $webshopProduct)
                        <div class="product">
                            <div class="image" style="background-image: url('{{ asset('assets/' . $webshopProduct->assets()->first()->file) }}')">
                                <div class="overlay">
                                    <a href="{{ route('webshopProduct', $webshopProduct->slug) }}" class="stretched-link">Bekijk product</a>
                                </div>
                            </div>
                            <div class="title">{{ $webshopProduct->title }}</div>
                            @if ($webshopProduct->price > 0)
                                <div class="price">&euro; {{ price($webshopProduct->price) }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
