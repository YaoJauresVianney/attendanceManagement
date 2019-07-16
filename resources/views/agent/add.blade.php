@extends('main')

@section('title')
    Nouvel agent
@endsection
@section('content')
    <div class="card">
        <div class="card-title bg-light p-3"><h2>Nouvel agent</h2></div>
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-{{ session()->get('class') }}">{{ session()->get('message') }}</div>
            @endif
            <form action="{{ url('add-agent') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-2 form-group">
                        <label for="nom">Nom agent : </label>
                        <input type="text" name="nom" id="nom" class="form-control">
                        @if ($errors->has('nom'))
                            <div class="text-danger">{{ $errors->get('nom') }}
                        @endif
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="prenoms">Prénoms agent : </label>
                        <input type="text" name="prenoms" id="prenoms" class="form-control">
                        @if ($errors->has('prenoms'))
                            <div class="text-danger">{{ $errors->get('prenoms') }}
                        @endif
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="contacts">Contacts : </label>
                        <input type="text" name="contacts" id="contacts" class="form-control">
                        @if ($errors->has('contacts'))
                            <div class="text-danger">{{ $errors->get('contacts') }}
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="mecano">Mecano : </label>
                        <input type="text" name="mecano" id="mecano" class="form-control">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="matricule">Matricule : </label>
                        <input type="text" name="matricule" id="matricule" class="form-control">
                        @if ($errors->has('matricule'))
                            <div class="text-danger">{{ $errors->get('matricule') }}
                        @endif
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="service_id">Service : </label>
                        <select class="form-control" name="service_id">
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('service_id'))
                            <div class="text-danger">{{ $errors->get('service_id') }}
                        @endif
                    </div>
                </div>

                <button class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
    </div>
@endsection
