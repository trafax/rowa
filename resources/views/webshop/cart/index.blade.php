@extends('layouts.website')

@section('content')
    <div class="main container">
        <div class="top border-bottom">
            <div class="breadcrumbs">
                <a href="/">Home</a> / Winkelwagen
            </div>
        </div>

        <h1 class="mt-4">Winkelwagen</h1>

        <form action="{{ route('webshopCart.update') }}" method="post">
            @csrf
            <div class="row product-container my-4">
                <div class="col-md-12">
                    @if (session()->get('cart')['items'])
                        <div class="border-bottom py-2">
                            <div class="row font-weight-bold">
                                <div class="col">Product</div>
                                <div class="col">Aantal</div>
                                <div class="col text-right">Prijs</div>
                            </div>
                        </div>
                    @endif

                    @forelse (session()->get('cart')['items'] ?? [] as $key => $row)
                        <div class="border-bottom py-4">
                            <div class="row">
                                <div class="col">
                                    <span class="font-weight-bold">{{ $row['title'] }}</span>
                                    <div class="">
                                        @foreach ($row['options'] ?? [] as $optionTitle => $optionValue)
                                            <span class="text-secondary"><span class="font-weight-bold">{{ $optionTitle }}</span>: {{ $optionValue }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col"><input type="number" name="qty[{{ $key }}]" value="{{ $row['qty'] }}" class="form-control col-2"></div>
                                <div class="col text-right">&euro; {{ price($row['price'] * $row['qty']) }}</div>
                            </div>
                        </div>
                    @empty
                        <p>Geen producten in de winkelwagen</p>
                    @endforelse

                    @if (session()->get('cart')['items'])
                        <div class="mt-4 py-2">
                            <div class="row font-weight-bold">
                                <div class="col text-right">Sub-totaal</div>
                                <div class="col-1 text-right">&euro; {{ price(session()->get('cart.prices')['total']) }}</div>
                            </div>
                        </div>
                        <div class="py-2">
                            <div class="row font-weight-bold">
                                <div class="col text-right">Verzendkosten</div>
                                <div class="col-1 text-right">&euro; {{ price(session()->get('cart.prices')['shipping']) }}</div>
                            </div>
                        </div>
                        <div class="py-2">
                            <div class="row font-weight-bold">
                                <div class="col text-right">Totaal</div>
                                <div class="col-1 text-right">&euro; {{ price(session()->get('cart.prices')['total']) }}</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @if (session()->get('cart')['items'])
                <div class="pb-4 text-right border-top pt-4">
                    <button type="submit" class="btn btn-primary">Update winkelwagen</button>
                    <a href="{{ route('checkout') }}" class="btn btn-primary">Afrekenen</a>
                </div>
            @endif
        </form>
    </div>
@endsection
