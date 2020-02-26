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
                <h2 class="category">Bestelling geplaatst</h2>
                <p>Bedankt voor uw bestelling, wij zullen u informeren wanneer de bestelling verwerkt is.</p>
            </div>
        </div>
    </div>
@endsection
