@extends('layouts.admin')

@section('content')
<form action="{{ route('admin.webshopFilter.store') }}" method="post">
    @csrf
    <div class="container">
        <div class="d-flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.webshopFilter.index') }}">Filters</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Filter toevoegen</li>
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
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Naam filter</label>
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Sorteer waardes</label>
                            <select name="sort_by" class="form-control">
                                <option value="alfabetic">Alfabetisch</option>
                                <option value="price">Op prijs</option>
                                <option value="number">Tekst waarde met getal</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Selecteerbaar</label>
                            <select name="selectable" class="form-control">
                                <option value="1">Ja</option>
                                <option value="0">Nee</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
