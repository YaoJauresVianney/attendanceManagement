@extends('main')

@section('title')
    Liste des pointages
@endsection

@section('content')

<div class="row bg-light mx-auto">
        <div class="col-md-6 text-secondary"><h1>Liste des pointages</h1></div>
        <div class="col-md-6 d-flex align-items-center justify-content-end">
            
            <form action="{{ url('add-pointages') }}" method="post">
                <div class="form-group d-flex">
                        @csrf
                    <select class="form-control agent_id" name="agent_id">
                        @foreach($agents as $agent)
                            @if(!in_array($agent->id, $agentsPresents))
                                <option value="{{ $agent->id }}">{{ $agent->nom . ' ' . $agent->prenoms }}</option>
                            @endif
                        @endforeach
                    </select>
                    <input type="submit" class="btn btn-outline-secondary" value="Pointe">
                </div>
            </form>
        </div>
</div>
<form action="" method="get">
    <div class="row">
        <div class="form-group col-md-4 d-flex">
            <input type="text" name="search" class="form-control" placeholder="Entrez un nom"><input type="submit" value="chercher" class="btn btn-primary">
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
            <th>Date arrivée</th>
            <th>Date Départ</th>
            <th>Nom agent</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pointages as $pointage)
            <tr>
                <td>{{ $pointage->id }}</td>
                <td>{{ $pointage->date_arrival }}</td>
                <td>{{ $pointage->date_departure }}</td>
                <td>
                    {{ 
                        (Illuminate\Support\Facades\DB::table('agents')->where('id', $pointage->agent_id))->get('nom') . ' ' .
                        (Illuminate\Support\Facades\DB::table('agents')->where('id', $pointage->agent_id))->get('prenoms')
                    }}
                </td>
                <td>
                    @if($pointage->date_departure == null)
                        <form action="{{ url('update-pointage') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value={{ $pointage->id }}>
                            <input type="submit" class="btn btn-outline-secondary" value="Départ">
                        </form>
                    @endif
                </td>
            </tr>   
        @endforeach
        
    </tbody>
</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
    $('.agent_id').select2({
      placeholder: 'Selectionnez'
    });
});
function hideSelect2Keyboard(e){
    $('.select2-search input, :focus,input').prop('focus',false).blur();
}

$("select").select2().on("select2-open", hideSelect2Keyboard);

$("select").select2().on("select2-close",function(){
    setTimeout(hideSelect2Keyboard, 50);
});
</script>
@endsection