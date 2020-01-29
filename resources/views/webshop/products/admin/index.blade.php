@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Producten</li>
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
                        <option value="{{ route('admin.webshopProduct.delete_selected') }}">Verwijder geselecteerde</option>
                    </select>
                </div>
                <div>
                    <a href="{{ route('admin.webshopProduct.create') }}" class="btn btn-primary btn-sm">Product toevoegen</a>
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
                <th scope="col">Titel</th>
                <th scope="col">Link</th>
                <th scope="col">Categorie</th>
                <th scope="col">Laatst aangepast op</th>
            </tr>
        </thead>
        <tbody class="sortable" data-action="{{ route('admin.webshopCategory.sort') }}">
            @foreach ($objects as $obj)
                <tr id="{{ $obj->id }}">
                    <td><input type="checkbox" name="ids[]" class="check" value="{{ $obj->id }}"></td>
                    <td><a href="{{ route('admin.webshopProduct.edit', $obj) }}">{{ $obj->title }}</a></td>
                    <td>{{ $obj->slug }}</td>
                    <td>{{ $obj->category->title }}</td>
                    <td>{{ $obj->updated_at->format('d-m-Y \o\m H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
