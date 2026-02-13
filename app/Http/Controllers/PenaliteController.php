<?php

namespace App\Http\Controllers;

use App\Models\Penalite;

class PenaliteController extends Controller
{
    public function mesPenalites()
    {
        $penalites = Penalite::with(['emprunt.livre'])
            ->whereHas('emprunt', fn($q) => $q->where('user_id', auth()->id()))
            ->orderBy('created_at', 'desc')
            ->get();

        return view('penalites.mes', compact('penalites'));
    }

    public function payer(Penalite $penalite)
    {
        $penalite->update(['payee' => true]);
        return back()->with('success', 'Pénalité marquée payée.');
    }
}
