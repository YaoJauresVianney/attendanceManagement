@extends('main')

@section('title')
    Ajout sous-direction
@endsection

@section('content')
    <div class="card">
        <div class="card-title bg-light p-3"><h2>Nouvelle sous-direction</h2></div>
        <div class="card-body">
            <form action="{{ url('add-sous-dir') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nom">Nom sous-direction : </label>
                            <input type="text" name="nom" id="nom" class="form-control">
                            @if($errors->has('nom'))
                                <div class="text-danger">{{ $errors->first('nom') }}</div>
                            @endif
                        </div>
                        <input type="submit" class="btn btn-primary" value="Enregistrer">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
