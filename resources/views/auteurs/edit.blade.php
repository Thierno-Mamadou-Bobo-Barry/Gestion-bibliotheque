<x-app-layout>
    <div class="p-6 max-w-xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Modifier l'auteur</h1>

        <form method="POST"
              action="{{ route('auteurs.update', $auteur) }}"
              class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-1">Nom</label>
                <input type="text"
                       name="nom"
                       value="{{ old('nom', $auteur->nom) }}"
                       class="w-full border rounded p-2">

                @error('nom')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block mb-1">Prénom</label>
                <input type="text"
                       name="prenom"
                       value="{{ old('prenom', $auteur->prenom) }}"
                       class="w-full border rounded p-2">

                @error('prenom')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex gap-2">
                <a href="{{ route('auteurs.index') }}"
                   class="px-4 py-2 border rounded">
                    Annuler
                </a>

                <button type="submit"
                        class="px-4 py-2 border rounded">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
