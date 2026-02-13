<x-app-layout>
    <div class="p-6 max-w-6xl mx-auto">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-bold">Catalogue</h1>
            <a href="{{ route('emprunts.index') }}" class="underline">Mes emprunts</a>
        </div>

        <form method="GET" class="mb-4 flex gap-2">
            <input name="q" value="{{ $q }}" placeholder="Rechercher (titre, auteur, catégorie, isbn)..."
                   class="w-full border rounded p-2">
            <button class="px-4 py-2 bg-black text-white rounded">OK</button>
        </form>

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
                        <th class="p-3 text-left">Titre</th>
                        <th class="p-3 text-left">Catégorie</th>
                        <th class="p-3 text-left">Auteurs</th>
                        <th class="p-3 text-left">Disponibilité</th>
                        <th class="p-3 text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($livres as $livre)
                    <tr class="border-t">
                        <td class="p-3">{{ $livre->titre }}</td>
                        <td class="p-3">{{ $livre->categorie?->nom ?? '-' }}</td>
                        <td class="p-3">
                            {{ $livre->auteurs->map(fn($a)=>trim($a->prenom.' '.$a->nom))->join(', ') ?: '-' }}
                        </td>
                        <td class="p-3">
                            {{ $livre->quantite_disponible }} / {{ $livre->quantite_totale }}
                        </td>
                        <td class="p-3 text-right">
                            @if($livre->quantite_disponible > 0 && $livre->disponible)
                                <form method="POST" action="{{ route('emprunts.store') }}">
                                    @csrf
                                    <input type="hidden" name="livre_id" value="{{ $livre->id }}">
                                    <button class="px-3 py-1 bg-indigo-600 text-black rounded">
                                        Emprunter
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-400">Indisponible</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td class="p-3" colspan="5">Aucun livre.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $livres->links() }}
        </div>
    </div>
</x-app-layout>
