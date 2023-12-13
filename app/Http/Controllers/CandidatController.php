<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Storage;

class CandidatController extends Controller
{
    public function create (Request $request)
    {
        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Admin::find($PasseUser);
        $candidats = Candidat::all();
        return view ('/candidats/create_candidat', ['actel_user'=>$actel_user, 'candidats'=>$candidats]);
    }

    public function store(Request $request)
    {
        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Admin::find($PasseUser);

        // Valider les champs
        $request->validate([
            'nom' => 'required',
            'profil' => 'required|image|mimes:jpeg,png,jpg,gif', // Ajoutez la validation pour les images
            'slogan' => 'required',
        ]);

        // Télécharger l'image et obtenir le nom original
        $imageName = $request->file('profil')->getClientOriginalName();

        // Utiliser le nom d'origine pour enregistrer l'image
        $dataa =  Storage::disk('local')->put('public/candidats/' . $imageName, file_get_contents($request->file('profil')));
      
        // Créer le candidat avec le nom de l'image
        $data = Candidat::create([
            'nom' => $request->nom,
            'photo' => $imageName,
            'slogan' => $request->slogan,
        ]);

        if ($data) {
            return redirect()->back()->with('success', 'Candidat ajouté avec succès');
        } else {
            return redirect()->back()->with('fail', 'Erreur d\'ajout');
        }
    }

    public function edit_candidat(Request $request)
    {
        $candidats = Candidat::all();
        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Admin::find($PasseUser);
        return view ('/candidats/edit_candidat', ['actel_user'=>$actel_user, 'candidats'=>$candidats]);
    }
    public function edit(Request $request, $id)
    {
        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Admin::find($PasseUser);
        $candidat = Candidat::find($id);
        return view ('/admins/edit', ['actel_user'=>$actel_user, 'candidat'=>$candidat]);
    }
    public function update(Request $request, $id)
    {
        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Admin::find($PasseUser);
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
        $actel_user = Admin::find($PasseUser);
        $candidat = Candidat::find($id);
        $candidat->delete();
        return redirect()->back()->with('success', 'Candidat supprimé avec succès');
    }
}

