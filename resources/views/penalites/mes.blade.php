<x-app-layout>
    <div class="p-6 max-w-6xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Mes pénalités</h1>
            <a href="{{ route('catalogue.index') }}" class="underline">Retour catalogue</a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 rounded">{{ session('success') }}</div>
        @endif

        <div class="bg-white shadow rounded overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">Livre</th>
                        <th class="p-3 text-left">Jours retard</th>
                        <th class="p-3 text-left">Montant</th>
                        <th class="p-3 text-left">Statut</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($penalites as $p)
                    <tr class="border-t">
                        <td class="p-3">{{ $p->emprunt->livre->titre }}</td>
                        <td class="p-3">{{ $p->jours_retard }}</td>
                        <td class="p-3">{{ $p->montant }}</td>
                        <td class="p-3">
                            @if($p->payee)
                                <span class="text-green-600">Payée</span>
                            @else
                                <span class="text-red-600">Non payée</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td class="p-3" colspan="4">Aucune pénalité.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
