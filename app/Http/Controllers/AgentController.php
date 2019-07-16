<?php

namespace App\Http\Controllers;

use App\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Service;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{
    
    public function index(Request $request){
        if(!Auth::check()){
            return redirect()->to('/');
        }
        if($request->has('search')){
            $agents = DB::table('agents')
                ->where('nom', 'LIKE', '%' . $request->get('search') . '%')
                ->orWhere('prenoms', 'LIKE', '%' . $request->get('search') . '%')
                ->paginate(5);
            $links = $agents->appends(request()->except('page'))->links();
        } else {
            $agents = DB::table('agents')
                ->paginate(5);
            $links = $agents->render();
        }
        return view('agent.liste', compact('agents', 'links'));
    }
    public function create(){
        $services = DB::table('services')->get();
        return view('agent.add', compact('services'));
    }
    public function edit($id)
    {
        $agent = Agent::find($id);
        $services = DB::table('services')->get();
        return view('agent.edit', compact('agent', 'services'));
    }
    public function store(Request $request){
        // Validation
        $this->validate($request, [
            'nom' => 'required',
            'prenoms' => 'required',
            'contacts' => 'required',
            'matricule' => 'required',
            'service_id' => 'required'
        ], [
            'nom.required' => 'Le nom est obligatoire',
            'prenoms.required' => 'Le ou les prénoms sont obligatoire',
            'contacts.required' => 'Nous avons besoin des contacts',
            'matricule.required' => 'Le matricule est obligatoire',
            'service_id.required' => 'Veuillez choisir un service'
        ]);

        // Ajout nouvel enregistrement
        $back = DB::table('agents')->insert([
            'nom' => $request->get('nom'),
            'prenoms' => $request->get('prenoms'),
            'contacts' => $request->get('contacts'),
            'mecano' => $request->get('mecano'),
            'matricule' => $request->get('matricule'),
            'service_id' => $request->get('service_id'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // Recupération des messages
        if($back){
            return redirect()->to('list-agents')->with(['message' => 'Agent enregistré avec succès', 'class' => 'success']);
        }
        return back()->with(['message' => 'Echec de l\'ajout', 'class' => 'danger']);
    }
    public function update(Request $request){

        // Validation
        $this->validate($request, [
            'id' => 'required|exists:agents,id',
            'nom' => 'required',
            'prenoms' => 'required',
            'contacts' => 'required',
            'matricule' => 'required',
            'service_id' => 'required'
        ], [
            'id.exists' => 'Identifiant introuvable',
            'nom.required' => 'Le nom est obligatoire',
            'prenoms.required' => 'Le ou les prénoms sont obligatoire',
            'contacts.required' => 'Nous avons besoin des contacts',
            'matricule.required' => 'Le matricule est obligatoire',
            'service_id.required' => 'Veuillez choisir un service'
        ]);

        // Modification
        $back = DB::table('agents')
        ->where('id', $request->get('id'))
        ->update([
            'nom' => $request->get('nom'),
            'prenoms' => $request->get('prenoms'),
            'contacts' => $request->get('contacts'),
            'mecano' => $request->get('mecano'),
            'matricule' => $request->get('matricule'),
            'service_id' => $request->get('service_id'),
            'updated_at' => Carbon::now()
        ]);

        // Récupération des messages
        if($back){
            return redirect()->to('list-agents')->with(['message' => 'Agent modifié avec succès', 'class' => 'success']);
        }
        return back()->with(['message' => 'Echec de la modification de l\'agent', 'class' => 'danger']);
    }
    public function destroy($id){
        $back = DB::table('agents')->where('id', $id)
        ->delete();

        if($back){
            return back()->with(['message' => 'Agent supprimé avec succès', 'class' => 'success']);
        }
        return back()->with(['message' => 'Echec de la suppression de l\'agent', 'class' => 'danger']);
    }
}
