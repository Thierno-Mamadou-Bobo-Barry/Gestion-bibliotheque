<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function toggleActif(User $user)
    {
        // Empêcher de désactiver soi-même (optionnel)
        if ($user->id === auth()->id()) {
            return back()->with('error', "Tu ne peux pas désactiver ton propre compte.");
        }

        $user->update(['actif' => !$user->actif]);

        return back()->with('success', 'Statut utilisateur mis à jour.');
    }

    public function changeRole(Request $request, User $user)
    {
        $data = $request->validate([
            'role' => ['required', 'in:Radmin,Rbibliothecaire,Rlecteur'],
        ]);

        $user->update(['role' => $data['role']]);

        return back()->with('success', 'Rôle mis à jour.');
    }
}
