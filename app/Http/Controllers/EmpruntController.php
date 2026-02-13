<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Models\Livre;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EmpruntController extends Controller
{
    public function index()
    {
        $emprunts = auth()->user()->emprunts()
            ->with('livre')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('emprunts.index', compact('emprunts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'livre_id' => ['required', 'exists:livres,id'],
        ]);

        $livre = Livre::findOrFail($request->livre_id);

        if ($livre->quantite_disponible <= 0) {
            return back()->with('error', 'Livre non disponible.');
        }

        Emprunt::create([
            'user_id' => auth()->id(),
            'livre_id' => $livre->id,
            'date_emprunt' => Carbon::now(),
            'date_retour_prevue' => Carbon::now()->addDays(7),
        ]);

        $livre->decrement('quantite_disponible');

        return back()->with('success', 'Livre emprunté avec succès.');
    }
}
