<?php

namespace App\Http\Controllers;

use App\Models\Auteur;
use Illuminate\Http\Request;

class AuteurController extends Controller
{
    public function index()
    {
        $auteurs = Auteur::orderBy('nom')->get();
        return view('auteurs.index', compact('auteurs'));
    }

    public function create()
    {
        return view('auteurs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['nullable', 'string', 'max:255'],
        ]);

        Auteur::create($data);

        return redirect()->route('auteurs.index')->with('success', 'Auteur ajouté.');
    }

    public function edit(Auteur $auteur)
    {
        return view('auteurs.edit', compact('auteur'));
    }

    public function update(Request $request, Auteur $auteur)
    {
        $data = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['nullable', 'string', 'max:255'],
        ]);

        $auteur->update($data);

        return redirect()->route('auteurs.index')->with('success', 'Auteur modifié.');
    }

    public function destroy(Auteur $auteur)
    {
        $auteur->delete();
        return redirect()->route('auteurs.index')->with('success', 'Auteur supprimé.');
    }
}
