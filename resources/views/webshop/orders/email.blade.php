@extends('emailtemplates.email')

@section('content')
    {!! $emailTemplate->content !!}
@endsection
