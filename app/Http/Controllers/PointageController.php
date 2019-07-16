<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Pointage;
use Illuminate\Support\Facades\Auth;

class PointageController extends Controller
{
    public function index(Request $request)
    {
        if(!Auth::check()){
            return redirect()->to('/');
        }
        if($request->has('search')){
            $pointagesChoisi = DB::table('agents')->where('nom', 'LIKE', '%' . $request->get('search') . '%')->get();
            
            $po = [];
            foreach($pointagesChoisi as $u){
                $po []= $u->id;
            }
            
            $pointages = DB::table('pointages')->whereIn('agent_id', $po)->paginate(5);
            
            $links = $pointages->appends(request()->except('page'))->links();
        }
        else{
            $pointages = DB::table('pointages')->orderByDesc('date_arrival')->paginate(20);
            $links = $pointages->render();
        }
        // La liste des agents qui peuvent pointé à l'arrivée
        $p = DB::table('pointages')->where('date_departure', null)->get('agent_id');
        $agents = DB::table('agents')->get();
        $p1 = [];
        $p2 = [];
        foreach($p as $a){
            $p1 []= $a;
        }
        foreach($p1 as $b){
            $p2 []= $b;
        }
        $agentsPresents = [];
        foreach($p2 as $c){
            $agentsPresents []= $c->agent_id;
        }


        return view('pointage.liste', compact('pointages', 'links', 'agents', 'agentsPresents'));
    }

    public function store(Request $request){
        
        $idAgent = (int)$request->get('agent_id');
        // $pointagesAgent = DB::table('pointages')->where('agent_id', $idAgent)->orderByDesc('date_arrival')->limit(1)->get();
        
            // Validation
            $this->validate($request, [
                'agent_id' => 'required|exists:agents,id'
            ], [
                'agent_id.required' => 'L\'identifiant est obligatoire',
                'agent_id.exists' => 'Cet agent n\'existe pas'
            ]);

            // Enregistrement
            $back = DB::table('pointages')->insert([
                'agent_id' => $idAgent,
                'date_arrival' => Carbon::now(),
                'date_departure' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            // Récupération des messages
            if($back){
                return back()->with(['message' => 'Le pointage a été validé', 'class' => 'success']);
            }
            else {
                return back()->with(['message' => 'Le pointage n\'a pas pu être validé', 'class' => 'danger']);
            }
    }
    public function update(Request $request){
        // Validation
        $this->validate($request, [
            'id' => 'required|exists:pointages,id'
        ], [
            'id.required' => 'Identifiant obligatoire',
            'id.exists' => 'Id inexistant'
        ]);
        $id = $request->get('id');
        // Modification
        $pointage = DB::table('pointages')->where('id', $request->get('id'))->update([
            'date_departure' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        // Récupération des messages
        if($pointage){
            return back()->with(['message' => 'L\'agent ' . $id . ' vient de partir', 'class' => 'info']);
        }
        else {
            return back()->with(['message' => 'L\'opération tentée a échouée', 'class' => 'danger']);
        }
    }
}
