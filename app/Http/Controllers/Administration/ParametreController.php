<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Parametre;
use Illuminate\Http\Request;

class ParametreController extends Controller
{
    public function index()
    {
        $parametre = Parametre::first();
        return view('Administration.pages.settings.index', compact('parametre'));
    }

    public function update(Request $request)
    {
        $parametre = Parametre::first(); // On récupère l'unique enregistrement

        $request->validate([
            'name' => 'required|string|max:100',
            'numero_proprietaire' => 'required|string|max:10',
            'number_magasin' => 'required|string|max:10',
            'email' => 'required|email|unique:parametres,email,' . $parametre->id,
            'adresse' => 'required|string',
        ]);

        $parametre->update($request->all());

        return redirect()->back()->with('success', 'Paramètres mis à jour avec succès.');
    }

}
