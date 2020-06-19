@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Referenties</li>
            </ol>
        </nav>
        <div class="ml-auto">
            <div class="d-flex">
                <div class="mr-4 d-flex">
                    <div class="mr-4">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#referenties" role="tab" aria-controls="nav-home" aria-selected="true">Referenties</a>
        </div>
    </nav>

    <div class="tab-content py-4" id="nav-tabContent">
        <div class="tab-pane fade show active" id="referenties" role="tabpanel" aria-labelledby="nav-home-tab">
            @include ('assets.admin.dropzone_multiple', ['file_data' => true, 'parent_id' => 'referenties', 'reload_url' => route('admin.referentie.index'), 'assets' => App\Models\Asset::where('parent_id', 'referenties')->orderBy('sort')->get(), 'anchor' => 'referenties'])
        </div>
    </div>

</div>
@endsection
