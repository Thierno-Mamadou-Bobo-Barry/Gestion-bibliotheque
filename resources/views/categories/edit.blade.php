<x-app-layout>
    <div class="p-6 max-w-xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Modifier la catégorie</h1>

        <form method="POST" action="{{ route('categories.update', $categorie) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-1">Nom</label>
                <input name="nom" value="{{ old('nom', $categorie->nom) }}" class="w-full border rounded p-2">
                @error('nom') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>

            <div class="flex gap-2">
                <a href="{{ route('categories.index') }}" class="px-4 py-2 border rounded">Annuler</a>
                <button class="px-4 py-2 bg-black text-white rounded">Mettre à jour</button>
            </div>
        </form>
    </div>
</x-app-layout>
