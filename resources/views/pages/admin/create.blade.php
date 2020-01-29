@extends('layouts.admin')

@section('content')
<form action="{{ route('admin.page.store') }}" method="post">
    @csrf
    <div class="container">
        <div class="d-flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.page.index') }}">Pagina's</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pagina toevoegen</li>
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
                            <label>Titel pagina</label>
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Plaats in</label>
                            <select name="parent_id" class="form-control">
                                <option value="0">Hoofdpagina</option>
                                @foreach (App\Models\Page::where('parent_id', 0)->orderBy('sort')->get() as $page)
                                    <option value="{{ $page->id }}">{{ $page->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Menu afbeelding</label>
                            @include ('assets.admin.single', ['name' => 'navigation_image', 'value' => ''])
                        </div>
                        <div class="form-group">
                            <label>Toon sub-categorieën in menu</label>
                            <select name="webshop_category_id" class="form-control">
                                <option value="0">Geen</option>
                                @foreach (App\Models\WebshopCategory::where('parent_id', 0)->orderBy('sort')->get() as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Hyperlink</label>
                            <input type="text" name="hyperlink" value="{{ old('hyperlink') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Toon in menu</label>
                            <select name="show_in_menu" class="form-control">
                                <option value="1">Ja</option>
                                <option value="0">Nee</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Toon als blok op homepagina</label>
                            <select name="show_on_home" class="form-control">
                                <option value="0">Nee</option>
                                <option value="1">Ja</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
