@extends('admin.layouts.app')

@section('title', 'Benutzerverwaltung')

@section('content')
<div class="bg-white dark:bg-gray-800 p-6 rounded shadow-md">
    <h1 class="text-xl font-bold mb-4">Benutzerverwaltung</h1>
    <table class="w-full border-collapse">
        <tr class="bg-gray-300 dark:bg-gray-700">
            <th class="p-2 border">ID</th>
            <th class="p-2 border">Name</th>
            <th class="p-2 border">E-Mail</th>
            <th class="p-2 border">Aktionen</th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td class="p-2 border">{{ $user->id }}</td>
            <td class="p-2 border">{{ $user->name }}</td>
            <td class="p-2 border">{{ $user->email }}</td>
            <td class="p-2 border">
                <a href="{{ route('admin.users.edit', $user->id) }}" class="px-2 py-1 bg-blue-500 text-white rounded">Bearbeiten</a>
                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded">Löschen</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
