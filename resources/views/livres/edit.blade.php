<x-app-layout>
    <div class="p-6 max-w-xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Modifier un livre</h1>

        <form method="POST" action="{{ route('livres.update', $livre) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-1">Titre</label>
                <input name="titre" value="{{ old('titre', $livre->titre) }}" class="w-full border rounded p-2">
                @error('titre') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="block mb-1">ISBN</label>
                <input name="isbn" value="{{ old('isbn', $livre->isbn) }}" class="w-full border rounded p-2">
                @error('isbn') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="block mb-1">Année de publication</label>
                <input type="number" name="annee_publication" value="{{ old('annee_publication', $livre->annee_publication) }}" class="w-full border rounded p-2">
                @error('annee_publication') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="block mb-1">Quantité totale</label>
                <input type="number" name="quantite_totale" value="{{ old('quantite_totale', $livre->quantite_totale) }}" class="w-full border rounded p-2">
                @error('quantite_totale') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="disponible" id="disponible" {{ $livre->disponible ? 'checked' : '' }}>
                <label for="disponible">Disponible</label>
            </div>

            <div>
    <label class="block mb-1">Catégorie</label>
    <select name="categorie_id" class="w-full border rounded p-2">
        <option value="">-- Choisir --</option>
        @foreach($categories as $c)
            <option value="{{ $c->id }}"
                {{ old('categorie_id', $livre->categorie_id) == $c->id ? 'selected' : '' }}>
                {{ $c->nom }}
            </option>
        @endforeach
    </select>
</div>

            @php
    $selectedAuteurs = old('auteurs', $livre->auteurs->pluck('id')->toArray());
@endphp

<div>
    <label class="block mb-1">Auteurs</label>
    <div class="border rounded p-2 space-y-1">
        @foreach($auteurs as $a)
            <label class="flex items-center gap-2">
                <input type="checkbox" name="auteurs[]" value="{{ $a->id }}"
                    {{ in_array($a->id, $selectedAuteurs) ? 'checked' : '' }}>
                <span>{{ $a->prenom }} {{ $a->nom }}</span>
            </label>
        @endforeach
    </div>
</div>



            <div class="flex gap-2">
                <a href="{{ route('livres.index') }}" class="px-4 py-2 border rounded">Annuler</a>
                <button class="px-4 py-2 border rounded">Mettre à jour</button>
            </div>
        </form>
    </div>
</x-app-layout>
