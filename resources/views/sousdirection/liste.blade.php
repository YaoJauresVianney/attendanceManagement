@extends('main')

@section('title')
    Liste des sous-directions
@endsection

@section('content')
    <div class="row bg-light mx-auto">
        <div class="col-md-6 text-secondary"><h1>Liste des sous-directions</h1></div>
        <div class="col-md-6 d-flex align-items-center justify-content-end"><a href="{{ url('add-sous-dir') }}" class="btn btn-outline-secondary">Nouveau</a></div>
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
            <th>Id</th>
            <th>Nom</th>
            <th>Créer le</th>
            <th>Modifiée le</th>
            <th>Actions</th>
        </thead>
        <tbody>
        @foreach($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->created_at }}</td>
                <td>{{ $data->updated_at }}</td>
                <td class="d-flex justify-content-center">
                    <a href="{{ url('sous-dir' . '/' . $data->id . '/edit')  }}" class="btn btn-outline-secondary">Modifier</a>
                    <form action="{{ url('destroy-sous-dir') . '/' . $data->id }}" method="post">
                        @csrf
                        <input type="submit" class="btn btn-outline-danger ml-2" value="supprimer">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
