@extends('layouts.admin')

@section('content')
<form action="{{ route('admin.user.update', $webuser) }}" method="post">
    @method('PUT')
    @csrf
    <div class="container">
        <div class="d-flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Gebruikers</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Gebruiker aanpassen</li>
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
                <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#stock" role="tab" aria-controls="nav-home" aria-selected="true">Bedrijfsvoorraad</a>
            </div>
        </nav>
        <div class="tab-content py-4" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
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
            </div>
            <div class="tab-pane fade show" id="stock" role="tabpanel" aria-labelledby="nav-home-tab">

                <a onclick="return duplicateRow()" class="mb-4 btn btn-success" href="javascript:;">Nieuwe regel +</a>

                <div class="row basic-row d-none">
                    <div class="col">
                        <div class="form-group">
                            <input type="text" name="product_title[]" placeholder="Naam product" class="form-control">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            @include ('assets.admin.single', ['name' => 'image[]', 'value' => ''])
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <input type="text" name="product_qty[]" placeholder="Aantal" class="form-control">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <input type="text" name="product_collie[]" placeholder="Collie" class="form-control">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <select name="product_email_no_stock[]" class="form-control">
                                <option value="0">Nee</option>
                                <option value="1">Ja</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-1 text-right">
                        <a href="javascript:;" onclick="$(this).closest('.row').remove()">X</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group font-weight-bold">Product</div>
                    </div>
                    <div class="col">
                        <div class="form-group font-weight-bold">Afbeelding</div>
                    </div>
                    <div class="col-2">
                        <div class="form-group font-weight-bold">Aantal</div>
                    </div>
                    <div class="col-2">
                        <div class="form-group font-weight-bold">Collie</div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <button type="button" class="btn btn-sm btn-light font-weight-bold" data-toggle="tooltip" data-placement="top" title="Stuur e-mail wanneer voorraad op is">
                                &nbsp;?&nbsp;
                            </button>
                        </div>
                    </div>
                    <div class="col-1 text-right">
                    </div>
                </div>

                <hr class="mt-0">

                @foreach ($webuser->stock as $product)
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input type="text" name="product_title[]" value="{{ $product->title }}" placeholder="Naam product" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                @include ('assets.admin.single', ['name' => 'image[]', 'value' => $product->image])
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <input type="text" name="product_qty[]" value="{{ $product->qty }}" placeholder="Aantal" class="form-control">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <input type="text" name="product_collie[]" value="{{ $product->collie }}" placeholder="Collie" class="form-control">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <select name="product_email_no_stock[]" class="form-control">
                                    <option value="0">Nee</option>
                                    <option value="1" {{ $product->email_no_stock == 1 ? 'selected' : '' }}>Ja</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-1 text-right">
                            <a href="javascript:;" onclick="$(this).closest('.row').remove()">X</a>
                        </div>
                    </div>
                @endforeach

                {!! $webuser->stock->count() > 0 ? '<hr>' : '' !!}

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <input type="text" name="product_title[]" placeholder="Naam product" class="form-control">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            @include ('assets.admin.single', ['name' => 'image[]', 'value' => ''])
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <input type="text" name="product_qty[]" placeholder="Aantal" class="form-control">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <input type="text" name="product_collie[]" placeholder="Collie" class="form-control">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <select name="product_email_no_stock[]" class="form-control">
                                <option value="0">Nee</option>
                                <option value="1">Ja</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-1 text-right">
                        <a href="javascript:;" onclick="$(this).closest('.row').remove()">X</a>
                    </div>
                </div>

                <div id="rows"></div>

                <script type="text/javascript">
                    window.duplicateRow = function() {
                        $('.basic-row').clone().removeClass('basic-row').removeClass('d-none').appendTo('#rows');
                    }
                </script>
            </div>
        </div>
    </div>
</form>
@endsection
