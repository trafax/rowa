@extends('layouts.admin')

@section('content')
<form action="{{ route('admin.emailTemplates.update', $template) }}" method="post">
    @csrf
    @method('PUT')
    <div class="container">
        <div class="d-flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.emailTemplates.index') }}">E-mail templates</a></li>
                    <li class="breadcrumb-item active" aria-current="page">E-mail template aanpassen</li>
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
                            <label>Naam template</label>
                            <input type="text" name="title" value="{{ old('title', $template->title) }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Tekst</label>
                            <textarea class="editor" name="content">{!! $template->content !!}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
