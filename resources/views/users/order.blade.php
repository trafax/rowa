@extends('layouts.website')

@section('content')
    <div class="main container mb-4">
        <div class="top d-flex">
            <div class="breadcrumbs">
                <a href="/">Home</a> /
                <a href="{{ route('user.orders') }}">Bestellingen</a> /
                Bestelling {{ $order->order_nr }}
            </div>
        </div>
        <div class="row">
            <div class="col">
               @include('users.partials.sidebar')
            </div>
            <div class="col-md-9 category-container">
                <h2 class="category">Bestelling {{ $order->order_nr }}</h2>

                <hr>

                @foreach ($order->rules as $rule)
                    <div class="border-bottom py-4">
                        <div class="row">
                            <div class="col">
                                <span class="font-weight-bold">{{ $rule->product->title }}</span>
                                <div class="">
                                    @foreach ($rule['options'] ?? [] as $optionTitle => $optionValue)
                                        <span class="text-secondary"><span class="font-weight-bold">{{ $optionTitle }}</span>: {{ $optionValue }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col">{{ $rule->qty }}</div>
                            <div class="col text-right">&euro; {{ price($rule->product->price * $rule->qty) }}</div>
                        </div>
                    </div>
                @endforeach

                <div class="mt-4 py-2">
                    <div class="row font-weight-bold">
                        <div class="col text-right">Sub-totaal</div>
                        <div class="col-1 text-right">&euro; {{ price($order->price_sub_total) }}</div>
                    </div>
                </div>
                <div class="py-2">
                    <div class="row font-weight-bold">
                        <div class="col text-right">Verzendkosten</div>
                        <div class="col-1 text-right">&euro; {{ price($order->price_shipping) }}</div>
                    </div>
                </div>
                <div class="py-2">
                    <div class="row font-weight-bold">
                        <div class="col text-right">Totaal</div>
                        <div class="col-1 text-right">&euro; {{ price($order->price_total) }}</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
