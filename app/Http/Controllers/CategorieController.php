<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::orderBy('nom')->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => ['required', 'string', 'max:255', 'unique:categories,nom'],
        ]);

        Categorie::create($data);

        return redirect()->route('categories.index')->with('success', 'Catégorie ajoutée.');
    }

    public function edit(Categorie $category)
    {
        return view('categories.edit', ['categorie' => $category]);
    }

    public function update(Request $request, Categorie $category)
    {
        $data = $request->validate([
            'nom' => ['required', 'string', 'max:255', 'unique:categories,nom,' . $category->id],
        ]);

        $category->update($data);

        return redirect()->route('categories.index')->with('success', 'Catégorie modifiée.');
    }

    public function destroy(Categorie $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée.');
    }
}
