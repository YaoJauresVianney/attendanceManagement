<?php

namespace App\Http\Controllers;

use App\Service;
use App\SousDirection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    
    public function index(Request $request){
        if(!Auth::check()){
            return redirect()->to('/');
        }
        if($request->has('search')){
            $services = DB::table('services')
            ->where('name','LIKE', '%' . $request->get('search') . '%')
            ->paginate(4);
            $links = $services->appends(request()->except('page'))->links();
        }else {
            $services = DB::table('services')
                ->paginate(4);
            $links = $services->render();
        }
        return view('service.liste', compact('services', 'links'));
    }

    public function create()
    {
        $sdirections = DB::table('sous_directions')->get();
        return view('service.add', compact('sdirections'));
    }
    public function store(Request $request)
    {
        // Validation
        $this->validate($request, [
            'name' => 'required|min:3',
            'sous_direction_id' => 'required'
        ], [
            'name.required' => 'Veuillez indiquez le nom du service',
            'name.min' => 'Le nom de service doit avoir au moins 3 caractères',
            'sous_direction_id.required' => 'Il est obligatoire de renseigner une sous-diretion'
        ]);
        // Enregistrement
        $back = DB::table('services')
            ->insert([
                'name' => $request->get('name'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'sous_direction_id' => $request->get('sous_direction_id')
            ]);
        // Récupération des messages
        if($back){
            return redirect()->to('list-services')->with(['message' => 'Enregistrement réussi', 'class' => 'success']);
        }
        return redirect()->back()->with(['message' => 'Echec enregistrement', 'class' => 'danger']);
    }
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $sdirections = SousDirection::all();
        return view('service.edit', compact('service', 'sdirections'));
    }
    public function update(Request $request)
    {
        // Validation
        $this->validate($request, [
            'id' => 'required|exists:services,id',
            'name' => 'required|min:3'
        ], [
            'id.exists' => 'ID introuvable',
            'name.required' => 'Le nom du service est obligatoire'
        ]);
        // Modification
        $update = DB::table('services')
        ->where('id', $request->get('id'))
        ->update([
            'name' => $request->get('name'),
            'sous_direction_id' => $request->get('sous_direction_id'),
            'updated_at' => Carbon::now()
        ]);
        if($update){
            return redirect()->to('list-services')->with(['message'=>'Modification réussie', 'class'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Echec modification', 'class'=>'danger']);
    }
    public function destroy($id)
    {
        $destroy = DB::table('services')
            ->where('id', $id)
            ->delete();
        if($destroy){
            return redirect()->back()->with(['message' => 'Suppression réussie', 'class' => 'success']);
        }
        return redirect()->back()->with(['message' => 'Echec suppression', 'class' => 'success']);
    }
}
