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
        <div class="container">
            <div class="d-lg-flex float-left float-lg-none w-100">
                <div class="logo float-left">
                    <a href="/"><img src="/img/logo.png"></a>
                </div>
                <div class="top-menu ml-auto d-none d-lg-flex">
                    <div>
                        info@rowa.nl <span>|</span> 0223 - 521 280 <span>|</span> <a href="">login</a> <span>|</span>
                    </div>
                    <form class="ml-2">
                        <input type="text" name="search" placeholder="Zoek..." class="form-control">
                    </form>
                </div>
                <div class="d-sm-block d-lg-none float-right float-lg-none menu-toggle">
                    <a href="javascript:;" class="menu-toggle">TOGGLE</a>
                </div>
            </div>
            <div id="main-menu" class="float-right float-lg-none d-none d-lg-block">
                <ul>
                    <li><a href="">Home</a></li>
                    @foreach (\App\Models\Page::where(['parent_id' => '0'])->orderBy('sort')->get() as $menu)
                        <li>
                            <a href="#">{!! $menu->title !!}</a>
                            @if ($menu->children->count() > 0)
                            <div class="sub-menu">
                                <div class="container d-flex">
                                    <div class="d-none d-lg-block sub-menu-title">
                                        <h3>{!! $menu->title !!}</h3>
                                        @if ($menu->navigation_image)
                                            <img class="menu-image" src="{{ asset($menu->navigation_image) }}">
                                        @endif
                                    </div>
                                    <ul>
                                        @foreach ($menu->children as $child_menu)
                                            <li><a href="">{!! $child_menu->title !!}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    @yield('content')


</body>
</html>
