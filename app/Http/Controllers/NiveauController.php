<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use Illuminate\Http\Request;

class NiveauController extends Controller
{
    // LISTE
    public function index()
    {
        $niveaux = Niveau::all();
        return view('niveaux.index', compact('niveaux'));
    }

    // FORMULAIRE DE CREATION
    public function create()
    {
        return view('niveaux.create');
    }

    // ENREGISTREMENT
    public function store(Request $request)
    {
        $request->validate([
            'nom_niveaux' => 'required|max:100',
            'langue' => 'required|max:50',
            'frais_total' => 'required|numeric',
        ]);

        Niveau::create($request->all());

        return redirect()->route('niveaux.index')
                         ->with('success', 'Niveau créé avec succès');
    }

    // FORMULAIRE EDIT
    public function edit($id)
    {
        $niveau = Niveau::findOrFail($id);
        return view('niveaux.edit', compact('niveau'));
    }

    // MODIFICATION
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom_niveaux' => 'required|max:100',
            'langue' => 'required|max:50',
            'frais_total' => 'required|numeric',
        ]);

        $niveau = Niveau::findOrFail($id);
        $niveau->update($request->all());

        return redirect()->route('niveaux.index')
                         ->with('success', 'Niveau mis à jour avec succès');
    }

    // SUPPRESSION
    public function destroy($id)
    {
        Niveau::destroy($id);

        return redirect()->route('niveaux.index')
                         ->with('success', 'Niveau supprimé avec succès');
    }


}
