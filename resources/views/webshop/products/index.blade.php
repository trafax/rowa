@extends('layouts.website')

@section('content')
    <div class="main container">
        <form method="post" action="{{ route('webshopCart.add', $webshopProduct) }}">
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
                        <div class="col-md-2 bx-pager">
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
                    <div class="d-flex">
                        <span class="title">{{ $webshopProduct->title }}</span>
                        <span class="price ml-auto">&euro; {{ price($webshopProduct->price) }}</span>
                    </div>
                    <span class="sku">Artikelnummer: {{ $webshopProduct->sku }}</span>
                    <div class="my-4 border-top border-bottom py-4">
                        @foreach ($filters as $filter => $filterArr)
                            <div class="form-group">
                                <label class="font-weight-bold">{!! $filterArr[0]['title'] !!}</label>
                                <select class="form-control" name="filters[{{ $filter }}]">
                                    @foreach ($filterArr as $filterObj)
                                        <option>{!! $filterObj['value'] !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    </div>
                    <div>
                        <button class="border-0 btn-submit">Bestel nu!</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
