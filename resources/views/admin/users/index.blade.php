<x-app-layout>
    <div class="p-6 max-w-6xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Gestion des utilisateurs</h1>
            <a class="underline" href="{{ route('admin.stats') }}">Stats</a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 rounded">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-3 bg-red-100 rounded">{{ session('error') }}</div>
        @endif

        <div class="bg-white shadow rounded overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">Login</th>
                        <th class="p-3 text-left">Nom</th>
                        <th class="p-3 text-left">Email</th>
                        <th class="p-3 text-left">Rôle</th>
                        <th class="p-3 text-left">Actif</th>
                        <th class="p-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $u)
                    <tr class="border-t">
                        <td class="p-3">{{ $u->login }}</td>
                        <td class="p-3">{{ $u->name }}</td>
                        <td class="p-3">{{ $u->email }}</td>

                        <td class="p-3">
                            <form method="POST" action="{{ route('admin.users.role', $u) }}" class="flex gap-2 items-center">
                                @csrf
                                <select name="role" class="border rounded p-1">
                                    <option value="Radmin" {{ $u->role === 'Radmin' ? 'selected' : '' }}>Radmin</option>
                                    <option value="Rbibliothecaire" {{ $u->role === 'Rbibliothecaire' ? 'selected' : '' }}>Rbibliothecaire</option>
                                    <option value="Rlecteur" {{ $u->role === 'Rlecteur' ? 'selected' : '' }}>Rlecteur</option>
                                </select>
                                <button class="underline text-indigo-600" type="submit">Changer</button>
                            </form>
                        </td>

                        <td class="p-3">
                            @if($u->actif)
                                <span class="text-green-600">Oui</span>
                            @else
                                <span class="text-red-600">Non</span>
                            @endif
                        </td>

                        <td class="p-3 text-right">
                            <form method="POST" action="{{ route('admin.users.toggle', $u) }}">
                                @csrf
                                <button class="px-3 py-1 bg-black text-indigo-700 rounded" type="submit">
                                    {{ $u->actif ? 'Désactiver' : 'Activer' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
