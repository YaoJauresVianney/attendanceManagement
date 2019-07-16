@extends('main')

@section('title')
    Modification agent
@endsection

@section('content')
    <div class="card">
        <div class="card-title bg-light p-3"><h2>Modification agent</h2></div>
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-{{ session()->get('class') }}">{{ session()->get('message') }}</div>
            @endif
            <form action="{{ url('update-agent') }}" method="post">
                @csrf
                <input type="hidden" value={{ $agent->id }} name="id">
                @if ($errors->has('id'))
                <div class="text-danger">{{ $errors->get('id') }}
                @endif
                <div class="row">
                    <div class="col-md-2 form-group">
                        <label for="nom">Nom agent : </label>
                        <input type="text" name="nom" id="nom" class="form-control" value="{{ $agent->nom }}">
                        @if ($errors->has('nom'))
                            <div class="text-danger">{{ $errors->get('nom') }}
                        @endif
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="prenoms">Prénoms agent : </label>
                        <input type="text" name="prenoms" id="prenoms" class="form-control" value="{{ $agent->prenoms }}">
                        @if ($errors->has('prenoms'))
                            <div class="text-danger">{{ $errors->get('prenoms') }}
                        @endif
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="contacts">Contacts : </label>
                        <input type="text" name="contacts" id="contacts" class="form-control" value="{{ $agent->contacts }}">
                        @if ($errors->has('contacts'))
                            <div class="text-danger">{{ $errors->get('contacts') }}
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="mecano">Mecano : </label>
                        <input type="text" name="mecano" id="mecano" class="form-control" value="{{ $agent->mecano }}">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="matricule">Matricule : </label>
                        <input type="text" name="matricule" id="matricule" class="form-control" value="{{ $agent->matricule }}">
                        @if ($errors->has('matricule'))
                            <div class="text-danger">{{ $errors->get('matricule') }}
                        @endif
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="service_id">Service : </label>
                        <select class="form-control" name="service_id">
                            @foreach($services as $service)
                                @if($agent->service_id == $service->id)
                                    <option value="{{ $service->id }}" selected>{{ $service->name }}</option>
                                @else
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endif
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
