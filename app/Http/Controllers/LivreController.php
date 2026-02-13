<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use Illuminate\Http\Request;

use App\Models\Categorie;
use App\Models\Auteur;


class LivreController extends Controller
{
    public function index()
    {
        $livres = Livre::orderBy('created_at', 'desc')->paginate(10);
        return view('livres.index', compact('livres'));
    }

    public function create()
{
    $categories = Categorie::orderBy('nom')->get();
    $auteurs = Auteur::orderBy('nom')->get();

    return view('livres.create', compact('categories', 'auteurs'));
}


    public function store(Request $request)
    {
        $data = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'isbn' => ['required', 'string', 'max:50', 'unique:livres,isbn'],
            'annee_publication' => ['required', 'integer', 'min:1000', 'max:' . date('Y')],
            'quantite_totale' => ['required', 'integer', 'min:1'],
            'categorie_id' => ['nullable', 'exists:categories,id'],
            'auteurs' => ['nullable', 'array'],
            'auteurs.*' => ['exists:auteurs,id'],
        ]);

        $data['quantite_disponible'] = $data['quantite_totale'];
        $data['disponible'] = true;

        $livre = Livre::create($data);
        $livre->auteurs()->sync($request->input('auteurs', []));

        return redirect()->route('livres.index')->with('success', 'Livre ajouté avec succès.');

    }

    public function edit(Livre $livre)
{
    $categories = Categorie::orderBy('nom')->get();
    $auteurs = Auteur::orderBy('nom')->get();

    return view('livres.edit', compact('livre', 'categories', 'auteurs'));
}


    public function update(Request $request, Livre $livre)
    {
        $data = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'isbn' => ['required', 'string', 'max:50', 'unique:livres,isbn,' . $livre->id],
            'annee_publication' => ['required', 'integer', 'min:1000', 'max:' . date('Y')],
            'quantite_totale' => ['required', 'integer', 'min:1'],
            'disponible' => ['nullable'],
        ]);

        // Ajuster la quantité disponible si on change le total
        $diff = $data['quantite_totale'] - $livre->quantite_totale;
        $nouvelleDispo = $livre->quantite_disponible + $diff;
        if ($nouvelleDispo < 0) $nouvelleDispo = 0;

        $livre->update([
            'titre' => $data['titre'],
            'isbn' => $data['isbn'],
            'annee_publication' => $data['annee_publication'],
            'quantite_totale' => $data['quantite_totale'],
            'quantite_disponible' => $nouvelleDispo,
            'disponible' => isset($data['disponible']) ? true : false,
        ]);

        $livre->auteurs()->sync($request->input('auteurs', []));

        return redirect()->route('livres.index')->with('success', 'Livre modifié avec succès.');
    }

    public function destroy(Livre $livre)
    {
        $livre->delete();
        return redirect()->route('livres.index')->with('success', 'Livre supprimé.');
    }
}
