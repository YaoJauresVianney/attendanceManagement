@extends('main')

@section('title')
    Liste des utilisateurs  
@endsection

@section('content')
<div class="row bg-light mx-auto">
        <div class="col-md-6 text-secondary"><h1>Liste des utilisateurs</h1></div>
        <div class="col-md-6 d-flex align-items-center justify-content-end"><a href="" class="btn btn-outline-secondary">Nouveau</a></div>
    </div>
    <table class="table table-stripped">
    <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>Nom utilisateur</th>
            <th>Email</th>
            <th>Créer le</th>
            <th>Modifiée le</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>jduser1</td>
            <td>jd@gg.flo</td>
            <td>2019-03-15 15:50</td>
            <td>2019-03-15 15:50</td>
        </tr>
    </tbody>
</table>   
@endsection