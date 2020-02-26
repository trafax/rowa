@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Gebruikers</li>
            </ol>
        </nav>
        <div class="ml-auto">
            <div class="d-flex">
                <div class="mr-4 d-flex">
                    <div class="mr-4">
                        <form method="post" action="{{ route('admin.user.search') }}">
                            @csrf
                            <input type="text" name="search" value="" placeholder="Zoeken..." class="form-control form-control-sm">
                        </form>
                    </div>
                    <select name="" class="form-control form-control-sm with-selected">
                        <option value="">Met geselecteerde</option>
                        <option value="{{ route('admin.user.delete_selected') }}">Verwijder geselecteerde</option>
                    </select>
                </div>
                <div>
                    <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-sm">Klant toevoegen</a>
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
                <th scope="col">Naam</th>
                <th scope="col">Bedrijf</th>
                <th scope="col">Aantal bestellingen</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td><input type="checkbox" name="ids[]" class="check" value="{{ $user->id }}"></td>
                    <td><a href="{{ route('admin.user.edit', $user) }}">{{ $user->firstname }} {{ $user->preposition }} {{ $user->lastname }}</a></td>
                    <td>{{ $user->company_name }}</td>
                    <td>{{ $user->orders->count() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
