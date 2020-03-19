@extends('layouts.website')

@section('content')
    <div class="main container mb-4">
        <div class="top d-flex">
            <div class="breadcrumbs">
                <a href="/">Home</a> /
                Mijn voorraad
            </div>
        </div>
        <div class="row">
            <div class="col">
               @include('users.partials.sidebar')
            </div>
            <div class="col-md-9 category-container">
                <h2 class="category">Mijn voorraad</h2>
                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {!! session('message') !!}
                    </div>
                @endif

                <form method="post" action="{{ route('user.stock.order') }}">
                    @csrf
                    <div class="products-container mt-4">
                        @foreach (Auth::user()->stock as $webshopProduct)
                            <div class="product border p-2">
                                <div class="image" style="background-image: url('{{ asset($webshopProduct->image) }}')">
                                </div>
                                <div class="title">{{ $webshopProduct->title }}</div>
                                <div class="price mt-4">
                                    <select name="qty[{{ $webshopProduct->id }}]" class="form-control">
                                        @for ($i=0; $i<=(($webshopProduct->qty ?? 0) / ($webshopProduct->collie ?? 1)); $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- @csrf
                    @foreach (Auth::user()->stock as $product)
                        <div class="row py-1">
                            <div class="col font-weight-bold">{{ $product->title }}</div>
                            <div class="col-2 font-weight-bold">{{ $product->qty > 0 ? $product->qty : ($product->email_no_stock == 1 ? 'In bestelling' : 0) }}</div>
                            <div class="col-2 font-weight-bold">{{ $product->collie }}</div>
                            <div class="col-2">
                                <select name="qty[{{ $product->id }}]" class="form-control">
                                    @for ($i=0; $i<=(($product->qty ?? 0) / ($product->collie ?? 1)); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    @endforeach --}}

                    <hr>
                    <button type="submit" class="btn btn-success">Bestel geselecteerde producten</button>
                </form>
            </div>
        </div>
    </div>
@endsection
