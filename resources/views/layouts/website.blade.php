<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ mix('js/website.js') }}"></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ mix('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ mix('css/website.css') }}" rel="stylesheet">
</head>
<body>
    <div id="header">
        <div class="container main">
            <div class="d-lg-flex float-left float-lg-none w-100">
                <div class="logo float-left">
                    <a href="/"><img src="/img/logo.png"></a>
                </div>
                <div class="top-menu ml-auto d-none d-lg-flex">
                    <div>
                        info@rowa.nl <span>|</span> 0223 - 521 280 <span>|</span>
                        @if (Auth::user())
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Mijn gegevens
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('user.profile') }}">Mijn gegevens</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}">Uitloggen</a>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('checkout') }}">inloggen</a> <span>|</span>
                        @endif
                    </div>
                    <form class="ml-2" method="post" action="{{ route('search') }}">
                        @csrf
                        <input type="text" name="search" placeholder="Zoek..." class="form-control">
                    </form>
                </div>
                <div class="d-sm-block d-lg-none float-right float-lg-none menu-toggle">
                    <a href="javascript:;" class="menu-toggle">TOGGLE</a>
                </div>
            </div>
            <div id="main-menu" class="float-right float-lg-none d-none d-lg-block">
                <ul>
                    @foreach (\App\Models\Page::where(['parent_id' => '0', 'show_in_menu' => 1])->orderBy('sort')->get() as $menu)
                        <li>
                            @php $link = $menu->hyperlink ? $menu->hyperlink : route('page', $menu->slug); @endphp
                            <a href="{{ $menu->children->count() == 0 && $menu->webshop_category_id == 0 ? $link : '#' }}">{!! $menu->title !!}</a>
                            @if ($menu->children->count() > 0 || $menu->webshop_category_id > 0)
                            <div class="sub-menu">
                                <div class="container d-flex">
                                    <div class="d-none d-lg-block sub-menu-title">
                                        <h3>{!! $menu->title !!}</h3>
                                        @if ($menu->navigation_image)
                                            <img class="menu-image" src="{{ asset($menu->navigation_image) }}">
                                        @endif
                                    </div>
                                    <ul>
                                        @if ($menu->webshop_category_id > 0)
                                        @foreach (App\Models\WebshopCategory::where('parent_id', $menu->webshop_category_id)->orderBy('sort')->get() as $category)
                                            <li><a href="{{ route('webshopCategory', $category->slug) }}">{!! $category->title !!}</a></li>
                                        @endforeach
                                        @else
                                            @foreach ($menu->children as $child_menu)
                                                @php $link = $child_menu->hyperlink ? $child_menu->hyperlink : route('page', $child_menu->slug); @endphp
                                                <li><a href="{{ $link }}">{!! $child_menu->title !!}</a></li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            @endif
                        </li>
                    @endforeach
                    @if (session()->get('cart')['items'])
                        <li class="float-right m-0">
                            <a href="{{ route('webshopCart.index') }}"><img src="{{ asset('img/cart.png') }}" class="cart-image"></a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    @yield('content')

    <div class="footer">
        <div class="container main">
            <div class="row">
                <div class="col-md-3 text-center text-md-left mb-4">
                    @if (Auth::user() && Auth::user()->role == 'admin') <div class="inline-editor" data-identifier="footer-overview" data-action="/admin/text/store"> @endif
                        {!! text('footer-overview') !!}
                    @if (Auth::user() && Auth::user()->role == 'admin') </div> @endif
                </div>
                <div class="col-md-3 text-center text-md-left mb-4">
                    @if (Auth::user() && Auth::user()->role == 'admin') <div class="inline-editor" data-identifier="footer-home" data-action="/admin/text/store"> @endif
                        {!! text('footer-home') !!}
                    @if (Auth::user() && Auth::user()->role == 'admin') </div> @endif
                </div>
                <div class="col-md-3 text-center text-md-left mb-4">
                    @if (Auth::user() && Auth::user()->role == 'admin') <div class="inline-editor" data-identifier="footer-information" data-action="/admin/text/store"> @endif
                        {!! text('footer-information') !!}
                    @if (Auth::user() && Auth::user()->role == 'admin') </div> @endif
                </div>
                <div class="col-md-3 text-center text-md-left mb-4">
                    @if (Auth::user() && Auth::user()->role == 'admin') <div class="inline-editor" data-identifier="footer-extra" data-action="/admin/text/store"> @endif
                        {!! text('footer-extra') !!}
                    @if (Auth::user() && Auth::user()->role == 'admin') </div> @endif
                </div>
            </div>
        </div>
    </div>
    <div class="copyright text-center">
        &copy; {{ date('Y') }} Rowa | <a href="https://digital4u.nl/" target="_blank">Digital4u</a>
    </div>

</body>
</html>
