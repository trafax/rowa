@extends('layouts.website')

@section('content')
    <div class="main container mb-4">
        <div class="top d-flex">
            <div class="breadcrumbs">
                <a href="/">Home</a> /
                Mijn bestellingen
            </div>
        </div>
        <div class="row">
            <div class="col">
               @include('users.partials.sidebar')
            </div>
            <div class="col-md-9 category-container">
                <h2 class="category">Mijn bestellingen</h2>
                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {!! session('message') !!}
                    </div>
                @endif

                <table class="table mt-4">
                    <tr>
                        <th>Bestelling nr.</th>
                        <th>Datum</th>
                        <th>Prijs</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->order_nr }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>&euro; {{ price($order->price_total) }}</td>
                            <td>{{ $order->status }}</td>
                            <td class="text-right"><a href="{{ route('user.order.view', $order) }}">Bekijk bestelling</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
