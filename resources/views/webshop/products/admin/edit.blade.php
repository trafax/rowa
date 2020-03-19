@extends('layouts.admin')

@section('content')
<form action="{{ route('admin.webshopProduct.update', $object) }}" method="post">
    @csrf
    @method('PUT')
    <div class="container">
        <div class="d-flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.webshopProduct.index') }}">Producten</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Product wijzigen</li>
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
                <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#filters" role="tab" aria-controls="nav-home" aria-selected="true">Filters</a>
                <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#slides" role="tab" aria-controls="nav-home" aria-selected="true">Afbeeldingen</a>
                <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#users" role="tab" aria-controls="nav-home" aria-selected="true">Klanten</a>
            </div>
        </nav>
        <div class="tab-content py-4" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Titel product</label>
                            <input type="text" name="title" value="{{ old('title', $object->title) }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Tekst</label>
                            <textarea name="description" class="editor"{!! $object->description !!}></textarea>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Sku</label>
                            <input type="text" name="sku" value="{{ old('sku', $object->sku) }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Prijs</label>
                            <input type="text" name="price" value="{{ old('price', $object->price) }}" class="form-control" placeholder="0.00">
                        </div>
                        <div class="form-group">
                            <label>BTW</label>
                            <select class="form-control" name="tax">
                                @foreach (config('app.vat_rates') as $vat)
                                    <option {{ $object->tax == $vat ? 'selected' : '' }} value="{{ $vat }}">{{ $vat }}%</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Plaats in</label>
                            <select name="parent_id" class="form-control">
                                <option value="0">Hoofdcategorie</option>
                                @foreach (App\Models\WebshopCategory::where('parent_id', 0)->orderBy('sort')->get() as $category)
                                    <option {{ $object->parent_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->title }}</option>
                                    @foreach (App\Models\WebshopCategory::where('parent_id', $category->id)->orderBy('sort')->get() as $sub_category)
                                        <option {{ $object->parent_id == $sub_category->id ? 'selected' : '' }} value="{{ $sub_category->id }}"> - {{ $sub_category->title }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Drukwerkbestand van klant</label>
                            <select class="form-control" name="needs_image">
                                <option value="0">Nee</option>
                                <option value="1" {{ $object->needs_image == 1 ? 'selected' : '' }}>Ja</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show" id="filters" role="tabpanel" aria-labelledby="nav-home-tab">

                <p>
                    Opties kunnen op onderstaande manier toegoevoegd worden per variatie. Iedere regel is een nieuwe optie.<br>
                    <i><strong>naam, vaste prijs, meerprijs</strong></i>
                </p>

                <div class="card-group">

                    @foreach ($object->filters() as $filter)
                        {{-- {{ dump($filter) }} --}}
                    @endforeach

                    @foreach (App\Models\WebshopFilter::orderBy('sort')->get() as $filter)
                        <div class="card">
                            <div class="card-header">{{ $filter->title }}</div>
                            <div class="card-body">
                                @php
                                    $filter_content = '';
                                    foreach ($object->filters()->where('webshop_filter_id', $filter->id)->get() as $row)
                                    {
                                        $filter_content .= $row->pivot->value . ', ' . $row->pivot->fixed_price . ', ' . $row->pivot->added_price . "\r\n";
                                    }
                                @endphp
                                <textarea name="variation[{{ $filter->id }}]" class="form-control" rows="5" placeholder="naam, vaste prijs, meerprijs">{{ $filter_content }}</textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade show" id="slides" role="tabpanel" aria-labelledby="nav-home-tab">
                @include ('assets.admin.dropzone_multiple', ['parent_id' => $object->id, 'reload_url' => route('admin.webshopProduct.edit', $object), 'assets' => $object->assets, 'anchor' => 'images'])
            </div>
            <div class="tab-pane fade show" id="users" role="tabpanel" aria-labelledby="nav-home-tab">
                <p class="bg-light p-2 border">Wanneer dit product aan een klant gekoppeld wordt zal dit product alleen bij de klant zichtbaar zijn.</p>
                <hr>
                @foreach (App\Models\User::where('role', 'customer')->get() as $user)
                    <div class="form-group mb-0">
                        <label><input type="checkbox" {{ in_array($user->id, $object->users()->get()->pluck('id')->toArray()) ? 'checked' : '' }} name="user[]" value="{{ $user->id }}"> {{ $user->firstname }} {{ $user->preposition }} {{ $user->lastname }} ({{ $user->company_name }})</label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</form>
@endsection
