@extends('main')
@section('title')
    Ajout service
@endsection
@section('content')
    <div class="card">
        <div class="card-title bg-light p-3"><h2>Modification service</h2></div>
        <div class="card-body">
            @if(session()->has('message'))
                <div class="alert alert-{{ session()->get('class') }}">{{ session()->get('message') }}</div>
            @endif
            <form action="{{ 'add-service' }}" method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="name">Nom service : </label>
                        <input type="text" name="name" id="name" class="form-control">
                        @if($errors->has('name'))
                            <div class="text-danger">{{ $errors->get('name') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sous_direction_id">Sous direction : </label>
                        <select class="form-control" name="sous_direction_id">
                            @foreach($sdirections as $sdirection)
                                <option value={{ $sdirection->id }}>{{ $sdirection->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('sous_direction_id'))
                            <div class="text-danger">{{ $errors->get('sous_direction_id') }}</div>
                        @endif
                    </div>
                </div>
                <button class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
    </div>
@endsection
