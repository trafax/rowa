@extends('layouts.admin')

@section('content')
<form action="{{ route('admin.user.store') }}" method="post">
    @csrf
    <div class="container">
        <div class="d-flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Gebruikers</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Gebruiker toevoegen</li>
                </ol>
            </nav>
            <div class="ml-auto">
                <button type="submit" class="btn btn-primary btn-sm">Opslaan</button>
            </div>
        </div>
    </div>

    <div class="container">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
            </div>
        </nav>
        <div class="tab-content py-4" id="nav-tabContent">

            @if ($errors->any())
                <div class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="form-group">
                    <label>Bedrijfsnaam</label>
                    <input type="text" name="company_name" class="form-control" value="{{ old('company_name') }}">
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Voornaam</label>
                            <input type="text" name="firstname" class="form-control" value="{{ old('firstname') }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Tussenvoegsel</label>
                            <input type="text" name="preposition" class="form-control" value="{{ old('preposition') }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Achternaam</label>
                            <input type="text" name="lastname" class="form-control" value="{{ old('lastname') }}">
                        </div>
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
                    <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label>Wachtwoord</label>
                    <input type="password" name="password" class="form-control" value="">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
