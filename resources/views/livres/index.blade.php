<x-app-layout>
    <div class="p-6 max-w-6xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Livres</h1>
            <a href="{{ route('livres.create') }}"
                style="display:inline-block;background:red;color:white;padding:10px 14px;border-radius:8px;">
                 + Ajouter
            </a>


        </div>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="text-left p-3">Titre</th>
                        <th class="text-left p-3">ISBN</th>
                        <th class="text-left p-3">Année</th>
                        <th class="text-left p-3">Disponible</th>
                        <th class="text-right p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($livres as $livre)
                        <tr class="border-t">
                            <td class="p-3">{{ $livre->titre }}</td>
                            <td class="p-3">{{ $livre->isbn }}</td>
                            <td class="p-3">{{ $livre->annee_publication }}</td>
                            <td class="p-3">
                                {{ $livre->quantite_disponible }} / {{ $livre->quantite_totale }}
                            </td>
                            <td class="p-3 text-right space-x-2">
                                <a class="underline" href="{{ route('livres.edit', $livre) }}">Modifier</a>

                                <form class="inline"
                                      action="{{ route('livres.destroy', $livre) }}"
                                      method="POST"
                                      onsubmit="return confirm('Supprimer ce livre ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="underline text-red-600" type="submit">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="p-3" colspan="5">Aucun livre pour le moment.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $livres->links() }}
        </div>
    </div>
</x-app-layout>
