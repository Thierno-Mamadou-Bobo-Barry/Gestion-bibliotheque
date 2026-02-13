<x-app-layout>
    <div class="p-6 max-w-4xl mx-auto space-y-4">
        <h1 class="text-2xl font-bold">Dashboard Admin</h1>

        <div class="space-x-4">
            <a class="underline" href="{{ route('admin.stats') }}">Statistiques</a>
            <a class="underline" href="{{ route('admin.users.index') }}">Utilisateurs</a>
        </div>
    </div>
</x-app-layout>
