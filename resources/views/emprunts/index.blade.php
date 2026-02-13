<x-app-layout>
    <div class="p-6 max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Mes emprunts</h1>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 rounded">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-3 bg-red-100 rounded">{{ session('error') }}</div>
        @endif

        <div class="bg-white shadow rounded overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">Livre</th>
                        <th class="p-3 text-left">Date emprunt</th>
                        <th class="p-3 text-left">Retour prévu</th>
                        <th class="p-3 text-left">Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($emprunts as $e)
                        <tr class="border-t">
                            <td class="p-3">{{ $e->livre->titre }}</td>
                            <td class="p-3">{{ $e->date_emprunt }}</td>
                            <td class="p-3">{{ $e->date_retour_prevue }}</td>
                            <td class="p-3">
                                @if($e->retourne)
                                    <span class="text-green-600">Retourné</span>
                                @elseif(now()->gt($e->date_retour_prevue))
                                    <span class="text-red-600">En retard</span>
                                @else
                                    <span class="text-blue-600">En cours</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="p-3" colspan="4">Aucun emprunt.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
