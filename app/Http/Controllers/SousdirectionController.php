<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\SousDirection;
use Illuminate\Support\Facades\Auth;

class SousdirectionController extends Controller
{
    public function index(Request $request){
        if(!Auth::check()){
            return redirect()->to('/');
        }
        if($request->has('search')){
            $sousDirection = DB::table('sous_directions')
                ->where('name', 'LIKE', '%' . $request->get('search') . '%')
                ->paginate(2);
            $links = $sousDirection->appends(request()->except('page'))->links();
        }
        else {
            $sousDirection = DB::table('sous_directions')
                ->paginate(2);
            $links = $sousDirection->render();
        }

        return view('sousdirection.liste', ['datas' => $sousDirection, 'links' => $links]);
    }
    public function create()
    {
        return view('sousdirection.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|min:6'
        ], [
            'nom.required' => 'Le nom est obligatoire.',
            'nom.min' => 'Le nom est trop court.'
        ]);
        $create = DB::table('sous_directions')
            ->updateOrInsert([
                'name' => $request->get('nom'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

        if($create){
            return redirect()->to('list-sous-dir')->with(['message' => 'Enregistrement réussi', 'class' => 'success']);
        }
        return redirect()->to('list-sous-dir')->with(['message' => 'Enregistrement echoué', 'class' => 'danger']);
    }

    public function edit($id){
        $sousDirection = SousDirection::find($id);
        return view('sousdirection.edit', compact('sousDirection'));
    }

    public function update(Request $request){
        $this->validate($request, [
            'id' => 'required|exists:sous_directions,id',
            'nom' => 'required'
        ], [
            'id.exists' => 'ID introuvable',
            'nom.required' => 'Le nom est obligatoire'
        ]);
        $update = DB::table('sous_directions')
            ->where('id', $request->get('id'))
            ->update([
                'name' => $request->get('nom'),
                'updated_at' => Carbon::now()
            ]);
        if($update){
            return redirect()->to('list-sous-dir')->with(['message' => 'Modification réussie', 'class' => 'success']);
        }
        return redirect()->to('list-sous-dir')->with(['message' => 'Echec modification', 'class' => 'danger']);
    }

    public function destroy($id)
    {
        $destroy = DB::table('sous_directions')
            ->where('id', $id)
            ->delete();
        if($destroy){
            return redirect()->back()->with(['message' => 'Suppresion réussie', 'class' => 'success']);
        }
        return redirect()->back()->with(['message' => 'Echec suppression', 'class' => 'danger']);
    }
}
