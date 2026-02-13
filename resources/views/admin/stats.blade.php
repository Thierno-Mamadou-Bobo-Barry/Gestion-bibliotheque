<x-app-layout>
    <div class="p-6 max-w-6xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Statistiques Admin</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="p-4 bg-white shadow rounded">
                <div class="font-semibold">Utilisateurs (total)</div>
                <div class="text-2xl">{{ $stats['users_total'] }}</div>
                <div class="text-sm text-gray-600 mt-2">
                    Admin: {{ $stats['users_admin'] }} |
                    Bib: {{ $stats['users_bib'] }} |
                    Lecteur: {{ $stats['users_lecteur'] }}
                </div>
            </div>

            <div class="p-4 bg-white shadow rounded">
                <div class="font-semibold">Livres</div>
                <div class="text-2xl">{{ $stats['livres_total'] }}</div>
                <div class="text-sm text-gray-600 mt-2">
                    Exemplaires: {{ $stats['exemplaires_total'] }} |
                    Dispo: {{ $stats['exemplaires_dispo'] }}
                </div>
            </div>

            <div class="p-4 bg-white shadow rounded">
                <div class="font-semibold">Emprunts</div>
                <div class="text-2xl">{{ $stats['emprunts_total'] }}</div>
                <div class="text-sm text-gray-600 mt-2">
                    En cours: {{ $stats['emprunts_en_cours'] }} |
                    En retard: {{ $stats['emprunts_retard'] }}
                </div>
            </div>

            <div class="p-4 bg-white shadow rounded">
                <div class="font-semibold">Pénalités</div>
                <div class="text-2xl">{{ $stats['penalites_total'] }}</div>
                <div class="text-sm text-gray-600 mt-2">
                    Non payées: {{ $stats['penalites_non_payees'] }}
                </div>
            </div>

            <div class="p-4 bg-white shadow rounded">
                <div class="font-semibold">Montant pénalités (total)</div>
                <div class="text-2xl">{{ $stats['penalites_montant_total'] }}</div>
            </div>

            <div class="p-4 bg-white shadow rounded">
                <div class="font-semibold">Montant pénalités (non payé)</div>
                <div class="text-2xl">{{ $stats['penalites_montant_non_paye'] }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
