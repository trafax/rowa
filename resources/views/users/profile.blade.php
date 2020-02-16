@extends('layouts.website')

@section('content')
    <div class="main container mb-4">
        <div class="top d-flex">
            <div class="breadcrumbs">
                <a href="/">Home</a> /
                Mijn gegevens
            </div>
        </div>
        <div class="row">
            <div class="col">
               @include('users.partials.sidebar')
            </div>
            <div class="col-md-9 category-container">
                <h2 class="category">Mijn gegevens</h2>
                <hr>
                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {!! session('message') !!}
                    </div>
                @endif
                <form method="POST" action="{{ route('user.update') }}" class="mt-4">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Bedrijfsnaam</label>
                        <input type="text" name="company_name" class="form-control" value="{{ $webuser->company_name }}">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Voornaam</label>
                                <input type="text" name="firstname" class="form-control" value="{{ $webuser->firstname }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Tussenvoegsel</label>
                                <input type="text" name="preposition" class="form-control" value="{{ $webuser->preposition }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Achternaam</label>
                                <input type="text" name="lastname" class="form-control" value="{{ $webuser->lastname }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Straatnaam</label>
                                <input type="text" name="street" class="form-control" value="{{ $webuser->street }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Huisnummer</label>
                                <input type="text" name="house_number" class="form-control" value="{{ $webuser->house_number }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Postcode</label>
                                <input type="text" name="zipcode" class="form-control" value="{{ $webuser->zipcode }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Woonplaats</label>
                                <input type="text" name="city" class="form-control" value="{{ $webuser->city }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Telefoonnummer</label>
                                <input type="text" name="telephone" class="form-control" value="{{ $webuser->telephone }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>E-mailadres</label>
                        <input type="text" name="email" class="form-control" value="{{ $webuser->email }}">
                    </div>
                    <button class="btn btn-primary">Opslaan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
