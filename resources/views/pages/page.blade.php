@extends('layouts.website')

@section('content')
    <div class="container main">
        <h1>{{ $page->title }}</h1>
    </div>
    @include('pages.templates.' . $page->template ?? 'default')
@endsection
