@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Bestellingen</li>
            </ol>
        </nav>
        <div class="ml-auto">
            <div class="d-flex">
                <div class="mr-4 d-flex">
                    <div class="mr-4">
                        {{-- <form method="post" action="{{ route('admin.page.search') }}">
                            @csrf
                            <input type="text" name="search" value="" placeholder="Zoeken..." class="form-control form-control-sm">
                        </form> --}}
                    </div>
                    <select name="" class="form-control form-control-sm with-selected">
                        <option value="">Met geselecteerde</option>
                        <option value="{{ route('admin.webshopOrder.delete_selected') }}">Verwijder geselecteerde</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <table class="table" data-toggle="checkboxes" data-range="true">
        <thead>
            <tr>
                <th scope="col" style="width: 20px;"><input type="checkbox" name="check_all" value="1"></th>
                <th scope="col">Nr</th>
                <th scope="col">Datum</th>
                <th scope="col">Naam</th>
                <th scope="col">Prijs</th>
                <th scope="col">Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr id="{{ $order->id }}">
                    <td><input type="checkbox" name="ids[]" class="check" value="{{ $order->id }}"></td>
                    <td><a href="{{ route('admin.webshopOrder.show', $order) }}">{{ $order->order_nr }}</a></td>
                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                    <td>{{ $order->user->firstname }} {{ $order->user->preposition }} {{ $order->user->lastname }}</td>
                    <td>&euro; {{ price($order->price_total) }}</td>
                    <td>{!! $order->status == 'paid' ? '<span class="text-success">'. $order->status .'</span>' : $order->status !!}</td>
                    <td>
                        <a href="{{ route('admin.webshopOrder.download_pdf', $order) }}">PDF</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
