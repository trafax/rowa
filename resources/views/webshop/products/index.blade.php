@extends('layouts.website')

@section('content')
    <div class="main container">
        <form method="post" action="{{ route('webshopCart.add', $webshopProduct) }}" enctype="multipart/form-data">
            @csrf
            <div class="top d-flex border-bottom">
                <div class="breadcrumbs">
                    <a href="/">Home</a> /
                        <a href="{{ route('webshopCategory', $webshopProduct->category->slug) }}">{{ $webshopProduct->category->title }}</a> /
                        {{ $webshopProduct->title }}
                </div>
                <div class="ml-auto">
                    <a href="{{ route('webshopCategory', $webshopProduct->category->slug) }}">Terug naar overzicht</a>
                </div>
            </div>
            <div class="row product-container mt-4">
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-2 bx-pager d-none d-md-block">
                            @foreach ($webshopProduct->assets()->limit(6)->get() as $key => $asset)
                                <a href="javascript:;" data-slide-index="{{ $key }}" style="background-image: url('{{ asset('assets/' . $asset->file) }}')" class="thumb-image"></a>
                            @endforeach
                        </div>
                        <div class="col-md-10">
                            <div class="slider">
                                <div class="bx-slider">
                                    @foreach ($webshopProduct->assets as $asset)
                                        <a data-fancybox="gallery" href="{{ asset('assets/' . $asset->file) }}"><div class="main-image" style="background-image: url('{{ asset('assets/' . $asset->file) }}')"></div></a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <script type="text/javascript">
                        $('.bx-slider').bxSlider({
                            pagerCustom: '.bx-pager',
                            startSlide: 0
                        });
                    </script>

                    {!! $webshopProduct->description !!}

                    <a href="{{ route('webshopCategory', $webshopProduct->category->slug) }}" class="d-block mb-4 text-dark font-weight-bold">Bekijk alle {{ $webshopProduct->category->title }}</a>
                </div>
                <div class="col">

                    @if ($errors->any())
                        <div class="alert alert-warning" role="alert">
                            @foreach($errors->all() as $error)
                                {{ ucfirst($error) }}
                            @endforeach
                        </div>
                    @endif

                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {!! session('message') !!}
                        </div>
                    @endif

                    <div class="d-flex">
                        <span class="title">{{ $webshopProduct->title }}</span>
                        <span class="price ml-auto">
                            @if (($webshopProduct->users->count() > 0 &&  $webshopProduct->price > 0) || ($webshopProduct->users->count() < 1 &&  $webshopProduct->price > 0))
                                &euro; {{ price($webshopProduct->price) }}
                            @endif
                        </span>
                    </div>
                    <span class="sku">Artikelnummer: {{ $webshopProduct->sku }}</span>
                    <div class="mt-4 border-top pt-4 pb-1">
                        @foreach ($filters as $filter => $filterArr)
                            <div class="form-group">
                                <label class="font-weight-bold">{!! $filterArr[0]['title'] !!}</label>
                                <select class="form-control" name="filters[{{ $filter }}]">
                                    @foreach ($filterArr as $filterObj)
                                        @php
                                            $price = null;
                                            if ($filterObj['fixed_price'] > 0) $price = $filterObj['fixed_price'];
                                            if ($filterObj['added_price'] > 0) $price = $filterObj['added_price'];
                                        @endphp
                                        <option value="{{ $filterObj['slug'] }}">{!! $filterObj['value'] !!} {!! $price > 0 ? ( ($filterObj['added_price'] > 0 ? '+' : '') . '&euro; (' . price($price) . ')') : '' !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    @if ($webshopProduct->needs_image)
                    <div class="card mt-4 mb-4">
                        <div class="card-header font-weight-bold">Drukwerkbestand</div>
                        <div class="card-body">
                            <p>Upload hier uw afbeelding die op het product geplaatst moet worden.</p>
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile" data-browse="Bestand kiezen">Selecteer uw bestand</label>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="form-group">
                        <label>Aantal</label>
                        <input type="number" name="qty" value="1" class="form-control col-md-3">
                    </div>

                    <div>
                        <button class="border-0 btn-submit mb-4">Bestel nu!</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
