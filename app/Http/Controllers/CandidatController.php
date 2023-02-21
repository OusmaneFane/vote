<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use Illuminate\Http\Request;

class CandidatController extends Controller
{
    public function create (Request $request)
    {
        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Candidat::find($PasseUser);
        $candidats = Candidat::all();
        return view ('/candidats/create_candidat', ['actel_user'=>$actel_user, 'candidats'=>$candidats]);
    }

    public function store (Request $request)
    {
        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Candidat::find($PasseUser);
        // use modal create
        $request->validate([
            'nom' => 'required',
            'photo' => 'required',
            'slogan' => 'required',
        ]);
        $data = Candidat::create([
            'nom' => $request->nom,
            'photo' => $request->photo,
            'slogan' => $request->slogan,
        ]);
        if($data){
            return redirect()->back()->with('success', 'Candidat ajouté avec succès');
        }else {
            return redirect()->back()->with('fail', 'Erreur d\'ajout');
        }
    
    }
    public function edit_candidat(Request $request)
    {
        $candidats = Candidat::all();
        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Candidat::find($PasseUser);
        return view ('/candidats/edit_candidat', ['actel_user'=>$actel_user, 'candidats'=>$candidats]);
    }
    public function edit(Request $request, $id)
    {
        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Candidat::find($PasseUser);
        $candidat = Candidat::find($id);
        return view ('/admins/edit', ['actel_user'=>$actel_user, 'candidat'=>$candidat]);
    }
    public function update(Request $request, $id)
    {
        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Candidat::find($PasseUser);
        $candidat = Candidat::find($id);
        // use modal update
        $candidat->update([
            'nom' => $request->nom,
            'photo' => $request->photo,

        ]);


        return redirect()->back()->with('success', 'Candidat modifié avec succès');
    }
    public function delete(Request $request, $id)
    {
        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Candidat::find($PasseUser);
        $candidat = Candidat::find($id);
        $candidat->delete();
        return redirect()->back()->with('success', 'Candidat supprimé avec succès');
    }
}

