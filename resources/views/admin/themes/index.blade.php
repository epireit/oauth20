@extends('admin.layouts.app')

@section('title', 'Theme-Management')

@section('content')
<div class="bg-white dark:bg-gray-800 p-6 rounded shadow-md">
    <h1 class="text-xl font-bold mb-4">Theme-Management</h1>

    <h2 class="text-lg font-bold mb-2">Aktuelles Theme: {{ $activeTheme }}</h2>

    <table class="w-full border-collapse">
        <tr class="bg-gray-300 dark:bg-gray-700">
            <th class="p-2 border">Theme-Name</th>
            <th class="p-2 border">Aktionen</th>
        </tr>
        @foreach($themes as $theme)
        <tr>
            <td class="p-2 border">{{ basename($theme) }}</td>
            <td class="p-2 border">
                @if($activeTheme !== basename($theme))
                    <form action="{{ route('admin.themes.activate', basename($theme)) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="px-2 py-1 bg-blue-500 text-white rounded">Aktivieren</button>
                    </form>
                    <form action="{{ route('admin.themes.delete', basename($theme)) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded">Löschen</button>
                    </form>
                @else
                    <span class="px-2 py-1 bg-green-500 text-white rounded">Aktiv</span>
                @endif
            </td>
        </tr>
        @endforeach
    </table>

    <h2 class="text-lg font-bold mt-6 mb-2">Neues Theme hochladen</h2>
    <form action="{{ route('admin.themes.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="theme" class="block mt-2 p-2 border dark:bg-gray-700 dark:text-white">
        <button type="submit" class="mt-3 p-2 bg-blue-500 text-white rounded">Hochladen</button>
    </form>
</div>
@endsection
