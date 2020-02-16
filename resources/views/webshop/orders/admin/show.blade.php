@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.webshopOrder.index') }}">Bestellingen</a></li>
                <li class="breadcrumb-item active" aria-current="page">Bestelling {{ $order->order_nr }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container">
    {!! $email !!}
</div>
@endsection
