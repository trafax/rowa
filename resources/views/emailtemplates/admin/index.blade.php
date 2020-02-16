@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">E-mail templates</li>
            </ol>
        </nav>
        <div class="ml-auto">
            <div class="d-flex">
                <div class="mr-4 d-flex">
                    <select name="" class="form-control form-control-sm with-selected">
                        <option value="">Met geselecteerde</option>
                        <option value="{{ route('admin.emailTemplates.delete_selected') }}">Verwijder geselecteerde</option>
                    </select>
                </div>
                <div>
                    <a href="{{ route('admin.emailTemplates.create') }}" class="btn btn-primary btn-sm">Template toevoegen</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <table class="table" data-toggle="checkboxes" data-range="true">
        <thead>
            <tr>
                <th scope="col" style="width: 20px;"><input type="checkbox" name="check_all" value="1"></th>
                <th scope="col">Titel</th>
                <th scope="col">Laatst aangepast op</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($templates as $email_template)
                <tr id="{{ $email_template->id }}">
                    <td><input type="checkbox" name="ids[]" class="check" value="{{ $email_template->id }}"></td>
                    <td><a href="{{ route('admin.emailTemplates.edit', $email_template) }}">{{ $email_template->title }}</a></td>
                    <td>{{ $email_template->updated_at->format('d-m-Y \o\m H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
