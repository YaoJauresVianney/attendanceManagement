@extends('main')

@section('title')
    Modification d'une sous-direction
@endsection

@section('content')
    <div class="card">
        <div class="card-title bg-light p-3"><h2>Modification sous-direction</h2></div>
        <div class="card-body">
            <form action="{{ url('update-sous-dir') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $sousDirection->id }}">
                @if($errors->has('id'))
                    <div class="text-danger">{{ $errors->first('id') }}</div>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nom">Nom sous-direction : </label>
                            <input type="text" name="nom" id="nom" class="form-control" value="{{ $sousDirection->name }}">
                            @if($errors->has('nom'))
                                <div class="text-danger">{{ $errors->first('nom') }}</div>
                            @endif
                        </div>
                        <input type="submit" class="btn btn-primary" value="Valider">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
