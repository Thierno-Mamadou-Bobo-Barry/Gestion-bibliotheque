<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Models\Penalite;
use Illuminate\Support\Carbon;

class GestionEmpruntsController extends Controller
{
    public function index()
    {
        $emprunts = Emprunt::with(['user', 'livre', 'penalite'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('gestion_emprunts.index', compact('emprunts'));
    }

    public function retour(Emprunt $emprunt)
    {
        if ($emprunt->retourne) {
            return back()->with('error', 'Déjà retourné.');
        }

        // Marquer retourné
        $today = Carbon::now()->toDateString();

        $emprunt->update([
            'retourne' => true,
            'date_retour_effective' => $today,
        ]);

        // Remettre le stock
        $emprunt->livre->increment('quantite_disponible');

        // --- Pénalité si retard ---
        $tarifParJour = 500; // change si tu veux
        $jours = 0;

        if ($today > $emprunt->date_retour_prevue) {
            $jours = Carbon::parse($emprunt->date_retour_prevue)->diffInDays(Carbon::parse($today));
        }

        if ($jours > 0) {
            Penalite::updateOrCreate(
                ['emprunt_id' => $emprunt->id],
                [
                    'jours_retard' => $jours,
                    'montant' => $jours * $tarifParJour,
                    'payee' => false,
                ]
            );
        }

        return back()->with('success', 'Retour validé.');
    }
}
