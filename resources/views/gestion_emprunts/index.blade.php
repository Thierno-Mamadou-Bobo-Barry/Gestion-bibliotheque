<x-app-layout>
    <div class="p-6 max-w-6xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Gestion des emprunts</h1>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-3 bg-red-100 rounded">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white shadow rounded overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">Lecteur</th>
                        <th class="p-3 text-left">Livre</th>
                        <th class="p-3 text-left">Date emprunt</th>
                        <th class="p-3 text-left">Retour prévu</th>
                        <th class="p-3 text-left">Statut</th>
                        <th class="p-3 text-left">Pénalité</th>
                        <th class="p-3 text-right">Action</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($emprunts as $e)
                    <tr class="border-t">
                        <td class="p-3">
                            {{ $e->user->login }} - {{ $e->user->name }}
                        </td>

                        <td class="p-3">
                            {{ $e->livre->titre }}
                        </td>

                        <td class="p-3">
                            {{ $e->date_emprunt }}
                        </td>

                        <td class="p-3">
                            {{ $e->date_retour_prevue }}
                        </td>

                        <td class="p-3">
                            @if($e->retourne)
                                <span class="text-green-600">Retourné</span>
                            @elseif(now()->gt($e->date_retour_prevue))
                                <span class="text-red-600">En retard</span>
                            @else
                                <span class="text-blue-600">En cours</span>
                            @endif
                        </td>

                        {{-- Pénalité --}}
                        <td class="p-3">
                            @if($e->penalite)
                                <div class="space-y-1">
                                    <div class="font-semibold">
                                        {{ $e->penalite->montant }} ({{ $e->penalite->jours_retard }}j)
                                    </div>

                                    @if($e->penalite->payee)
                                        <span class="text-green-600 text-sm">Payée</span>
                                    @else
                                        <form method="POST" action="{{ route('penalites.payer', $e->penalite) }}">
                                            @csrf
                                            <button class="underline text-indigo-600" type="submit">
                                                Marquer payée
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>

                        {{-- Action retour --}}
                        <td class="p-3 text-right">
                            @if(!$e->retourne)
                                <form method="POST" action="{{ route('gestion_emprunts.retour', $e) }}">
                                    @csrf
                                    <button class="px-3 py-1 bg-black text-indigo-600 rounded" type="submit">
                                        Marquer retourné
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="p-3" colspan="7">
                            Aucun emprunt.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
