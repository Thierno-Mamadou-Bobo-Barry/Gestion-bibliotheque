<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Livre;
use App\Models\Emprunt;
use App\Models\Penalite;

class AdminStatsController extends Controller
{
    public function index()
    {
        $stats = [
            'users_total' => User::count(),
            'users_admin' => User::where('role', 'Radmin')->count(),
            'users_bib' => User::where('role', 'Rbibliothecaire')->count(),
            'users_lecteur' => User::where('role', 'Rlecteur')->count(),

            'livres_total' => Livre::count(),
            'exemplaires_total' => Livre::sum('quantite_totale'),
            'exemplaires_dispo' => Livre::sum('quantite_disponible'),

            'emprunts_total' => Emprunt::count(),
            'emprunts_en_cours' => Emprunt::where('retourne', false)->count(),
            'emprunts_retard' => Emprunt::where('retourne', false)->whereDate('date_retour_prevue', '<', now()->toDateString())->count(),

            'penalites_total' => Penalite::count(),
            'penalites_non_payees' => Penalite::where('payee', false)->count(),
            'penalites_montant_total' => Penalite::sum('montant'),
            'penalites_montant_non_paye' => Penalite::where('payee', false)->sum('montant'),
        ];

        return view('admin.stats', compact('stats'));
    }
}
