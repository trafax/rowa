@extends('layouts.admin')

@section('content')
<form action="{{ route('admin.webshopProduct.store') }}" method="post">
    @csrf
    <div class="container">
        <div class="d-flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.webshopProduct.index') }}">Producten</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Product toevoegen</li>
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
                            <label>Titel product</label>
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Tekst</label>
                            <textarea name="description" class="editor"></textarea>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Sku</label>
                            <input type="text" name="sku" value="{{ old('sku') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Prijs</label>
                            <input type="text" name="price" value="{{ old('price') }}" class="form-control" placeholder="0.00">
                        </div>
                        <div class="form-group">
                            <label>BTW</label>
                            <select class="form-control" name="tax">
                                @foreach (config('app.vat_rates') as $vat)
                                    <option value="{{ $vat }}">{{ $vat }}%</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Plaats in</label>
                            <select name="parent_id" class="form-control">
                                <option value="0">Hoofdcategorie</option>
                                @foreach (App\Models\WebshopCategory::where('parent_id', 0)->orderBy('sort')->get() as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @foreach (App\Models\WebshopCategory::where('parent_id', $category->id)->orderBy('sort')->get() as $sub_category)
                                        <option value="{{ $sub_category->id }}"> - {{ $sub_category->title }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
