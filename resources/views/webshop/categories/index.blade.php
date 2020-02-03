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
            <div class="col filters">
                @if ($filters)
                    <h2 class="category">FILTER</h2>
                    <hr>
                    <form method="post" action="{{ route('webshop_set_filter', $webshopCategory->slug) }}">
                        @csrf
                        @foreach ($filters as $filter => $filterArr)
                            <div class="form-group">
                                <label class="font-weight-bold">{!! $filterArr->title !!}</label>
                                @foreach ($filterArr->values as $filterObj)
                                    @php $checked = isset($active_filters[$filterArr->slug]) && in_array($filterObj->slug, explode(',', $active_filters[$filterArr->slug])) ? 'checked' : '' @endphp
                                    <label class="d-block"><input type="checkbox" {{ $checked }} name="filters[{{ $filterArr->slug }}][]" value="{{ $filterObj->slug }}"> {!! ucfirst($filterObj->value) !!}</label>
                                @endforeach
                            </div>
                        @endforeach
                    </form>
                    <script>
                        $(function(){
                            $('.filters input[type="checkbox"]').change(function(){
                                $('.filters form').submit();
                            });
                        });
                    </script>
                @endif
            </div>
            <div class="col-md-9 category-container">
                <h2 class="category">{{ $webshopCategory->title }}</h2>
                <div class="description">{!! $webshopCategory->description !!}</div>
                <div class="products-container">
                    @foreach ($webshopProducts as $webshopProduct)
                        <div class="product">
                            <div class="image" style="background-image: url('{{ asset('assets/' . $webshopProduct->assets()->first()->file) }}')">
                                <div class="overlay">
                                    <a href="{{ route('webshopProduct', $webshopProduct->slug) }}" class="stretched-link">Bekijk product</a>
                                </div>
                            </div>
                            <div class="title">{{ $webshopProduct->title }}</div>
                            <div class="price">&euro; {{ price($webshopProduct->price) }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
