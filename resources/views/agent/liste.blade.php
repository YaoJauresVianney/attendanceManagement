@extends('main')

@section('title')
    Liste des agents
@endsection

@section('content')

<div class="row bg-light mx-auto">
        <div class="col-md-6 text-secondary"><h1>Liste des agents</h1></div>
        <div class="col-md-6 d-flex align-items-center justify-content-end"><a href="{{ url('add-agents') }}" class="btn btn-outline-secondary">Nouveau</a></div>
</div>
<form action="" method="get">
    <div class="row">
        <div class="form-group col-md-4 d-flex">
            <input type="text" name="search" class="form-control"><input type="submit" value="chercher" class="btn btn-primary">
        </div>
    </div>
</form>
@if(session()->has('message'))
    <div class="alert alert-{{ session()->get('class') }}">{!! session()->get('message') !!}</div>
@endif

{{ $links }}
<table class="table table-stripped">
    <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Prénoms</th>
            <th>Mecano</th>
            <th>Nom service</th>
            <th>Contacts</th>
            <th>Créer le</th>
            <th>Modifiée le</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($agents as $agent)
        <tr>
            <td>{{ $agent->id }}</td>
            <td>{{ $agent->nom }}</td>
            <td>{{ $agent->prenoms }}</td>
            <td>{{ $agent->mecano }}</td>
            <td>{{ str_replace('"}]', '', str_replace('[{"name":"', '', Illuminate\Support\Facades\DB::table('services')->where('id', '=', $agent->service_id)->get('name'))) }}</td>
            <td>{{ $agent->contacts }}</td>
            <td>{{ $agent->created_at }}</td>
            <td>{{ $agent->updated_at }}</td>
            <td class="d-flex justify-content-center">
                <a href="{{ url('agent') . '/' . $agent->id . '/edit' }}" class="btn btn-outline-secondary">Modifier</a>
                <form action="{{ url('destroy-agent') . '/' . $agent->id }}" method="post">
                    <input type="submit" class="btn btn-outline-danger" value="Supprimer">
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
