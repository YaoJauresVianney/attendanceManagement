@extends('main')

@section('title')
    Liste des services
@endsection

@section('content')

<div class="row bg-light mx-auto">
        <div class="col-md-6 text-secondary"><h1>Liste des services</h1></div>
        <div class="col-md-6 d-flex align-items-center justify-content-end"><a href="{{ url('add-service') }}" class="btn btn-outline-secondary">Nouveau</a></div>
</div>
<form action="" method="get">
    <div class="row">
        <div class="form-group col-md-4 d-flex">
            <input type="text" name="search" class="form-control"><input type="submit" value="chercher" class="btn btn-primary">
        </div>
    </div>
</form>
@if(session()->has('message'))
    <div class="alert alert-{{ session()->get('class') }}">{{ session()->get('message') }}</div>
@endif

<table class="table table-stripped">
    <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Nom sous-direction</th>
            <th>Créer le</th>
            <th>Modifiée le</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($services as $service)
        <tr>
            <td>{{ $service->id }}</td>
            <td>{{ $service->name }}</td>
            <td>{{ $service->sous_direction_id }}</td>
            <td>{{ $service->created_at }}</td>
            <td>{{ $service->updated_at }}</td>
            <td class="d-flex">
                <a href="{{ url('service') . '/' . $service->id . '/edit' }}" class="btn btn-outline-secondary">Modifier</a>
                <form action="{{ url('destroy-service') . '/' . $service->id }}" method="post">
                    @csrf
                    <input type="submit" class="btn btn-outline-danger ml-2" value="Supprimer">
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
