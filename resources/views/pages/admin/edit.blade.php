@extends('layouts.admin')

@section('content')
<form action="{{ route('admin.page.update', $obj) }}" method="post">
    @csrf
    @method('PUT')
    <div class="container">
        <div class="d-flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.page.index') }}">Pagina's</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pagina aanpassen</li>
                </ol>
            </nav>
            <div class="ml-auto">
                <button type="submit" class="btn btn-primary">Opslaan</button>
            </div>
        </div>
    </div>

    <div class="container">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
                <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#seo" role="tab" aria-controls="nav-home" aria-selected="true">Zoekmachine</a>
                {{-- <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#images" role="tab" aria-controls="nav-home" aria-selected="true">Afbeeldingen</a> --}}
            </div>
        </nav>
        <div class="tab-content py-4" id="nav-tabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Titel pagina</label>
                            <input type="text" name="title" value="{{ old('title', $obj->title) }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Tekst</label>
                            <textarea class="editor" name="content">{!! $obj->content !!}</textarea>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Plaats in</label>
                            <select name="parent_id" class="form-control">
                                <option value="0">Hoofdpagina</option>
                                @foreach (App\Models\Page::where('parent_id', 0)->where('id', '!=', $obj->id)->orderBy('sort')->get() as $page)
                                    <option {{ $obj->parent_id == $page->id ? 'selected' : '' }} value="{{ $page->id }}">{{ $page->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Menu afbeelding</label>
                            @include ('assets.admin.single', ['name' => 'navigation_image', 'value' => $obj->navigation_image])
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show" id="seo" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="form-group">
                    <label>Link</label>
                    <input type="text" name="slug" value="{{ old('slug', $obj->slug) }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Titel</label>
                    <input type="text" name="seo[title]" value="{{ old('seo[title]', $obj->seo['title']) }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Zoekwoorden</label>
                    <input type="text" name="seo[keywords]" value="{{ old('seo[keywords]', $obj->seo['keywords']) }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Omschrijving</label>
                    <textarea name="seo[description]" class="form-control">{{ old('seo[description]', $obj->seo['description']) }}</textarea>
                </div>
            </div>
            {{-- <div class="tab-pane fade show" id="images" role="tabpanel" aria-labelledby="nav-home-tab">
                @include ('assets.admin.dropzone_multiple', ['parent_id' => $obj->id, 'reload_url' => route('admin.page.edit', $obj), 'assets' => $obj->assets, 'anchor' => 'images'])
            </div> --}}
        </div>
    </div>
</form>
@endsection
