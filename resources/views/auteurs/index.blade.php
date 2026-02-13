<x-app-layout>
    <div class="p-6 max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Auteurs</h1>

            <a href="{{ route('auteurs.create') }}"
               class="display:inline-block;background:red;color:white;padding:10px 14px;border-radius:8px;">
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
                        <th class="text-left p-3">Nom</th>
                        <th class="text-left p-3">Prénom</th>
                        <th class="text-right p-3">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($auteurs as $auteur)
                        <tr class="border-t">
                            <td class="p-3">{{ $auteur->nom }}</td>
                            <td class="p-3">{{ $auteur->prenom }}</td>

                            <td class="p-3 text-right space-x-2">
                                <a class="underline"
                                   href="{{ route('auteurs.edit', $auteur) }}">
                                    Modifier
                                </a>

                                <form class="inline"
                                      method="POST"
                                      action="{{ route('auteurs.destroy', $auteur) }}"
                                      onsubmit="return confirm('Supprimer cet auteur ?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="underline text-red-600"
                                            type="submit">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="p-3" colspan="3">
                                Aucun auteur enregistré.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
