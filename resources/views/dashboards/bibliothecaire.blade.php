<x-app-layout>
    <div class="p-6 max-w-4xl mx-auto space-y-4">
        <h1 class="text-2xl font-bold">Dashboard Bibliothécaire</h1>

        <div class="space-x-4">
            <a class="underline" href="{{ route('livres.index') }}">Livres</a>
            <a class="underline" href="{{ route('categories.index') }}">Catégories</a>
            <a class="underline" href="{{ route('auteurs.index') }}">Auteurs</a>
            <a class="underline" href="{{ route('gestion_emprunts.index') }}">Gestion emprunts</a>
        </div>
    </div>
</x-app-layout>
