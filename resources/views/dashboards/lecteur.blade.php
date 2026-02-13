<x-app-layout>
    <div class="p-6 max-w-4xl mx-auto space-y-4">
        <h1 class="text-2xl font-bold">Dashboard Lecteur</h1>

        <div class="space-x-4">
            <a class="underline" href="{{ route('catalogue.index') }}">Catalogue</a>
            <a class="underline" href="{{ route('emprunts.index') }}">Mes emprunts</a>
            <a class="underline" href="{{ route('penalites.mes') }}">Mes pénalités</a>
        </div>
    </div>
</x-app-layout>
