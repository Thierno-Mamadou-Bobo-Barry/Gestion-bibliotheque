<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use Illuminate\Http\Request;

class CatalogueController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $livres = Livre::with(['categorie', 'auteurs'])
            ->when($q, function ($query) use ($q) {
                $query->where('titre', 'like', "%$q%")
                    ->orWhere('isbn', 'like', "%$q%")
                    ->orWhereHas('categorie', fn($qq) => $qq->where('nom', 'like', "%$q%"))
                    ->orWhereHas('auteurs', fn($qq) =>
                        $qq->where('nom', 'like', "%$q%")->orWhere('prenom', 'like', "%$q%")
                    );
            })
            ->orderBy('titre')
            ->paginate(10)
            ->withQueryString();

        return view('catalogue.index', compact('livres', 'q'));
    }
}
