@extends('layouts.website')

@section('content')
<div class="main container py-4">
    <div class="row">
        <div class="col-md-8 offset-1">
            <div class="card">
                <div class="card-header">Aanmelden nieuwe klant</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        @if (count($errors) > 0)
                            <div class="alert alert-warning" role="alert">
                                @foreach ($errors->all() as $error)
                                    <span class="d-block">{{ $error }}</span>
                                @endforeach
                            </div>
                        @endif
                        <div class="form-group">
                            <label>Bedrijfsnaam</label>
                            <input type="text" name="company_name" class="form-control" value="{{ old('company_name') }}">
                        </div>
                        <div class="form-group">
                            <label>Uw naam</label>
                            <div class="row">
                                <div class="col-4"><input type="text" name="firstname" class="form-control" placeholder="Voornaam" value="{{ old('firstname') }}" required></div>
                                <div class="col-2"><input type="text" name="preposition" class="form-control" placeholder="Tussenvoegsel" value="{{ old('preposition') }}"></div>
                                <div class="col"><input type="text" name="lastname" class="form-control" placeholder="Achternaam" value="{{ old('lastname') }}" required></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Straatnaam</label>
                                    <input type="text" name="street" class="form-control" value="{{ old('street') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Huisnummer</label>
                                    <input type="text" name="house_number" class="form-control" value="{{ old('house_number') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Postcode</label>
                                    <input type="text" name="zipcode" class="form-control" value="{{ old('zipcode') }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Woonplaats</label>
                                    <input type="text" name="city" class="form-control" value="{{ old('city') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Telefoonnummer</label>
                                    <input type="text" name="telephone" class="form-control" value="{{ old('telephone') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>E-mailadres</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Wachtwoord</label>
                            <input type="password" class="form-control" name="password" required autocomplete="new-password">
                        </div>
                        <div class="form-group">
                            <label>Bevestig wachtwoord</label>
                            <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Registreer mij als nieuwe klant</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
