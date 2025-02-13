@extends('admin.layouts.app')

@section('title', 'Branding-Einstellungen')

@section('content')
<div class="bg-white dark:bg-gray-800 p-6 rounded shadow-md">
    <h1 class="text-xl font-bold mb-4">Branding-Einstellungen</h1>

    <form action="{{ route('admin.branding.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label class="block font-semibold">Plattform-Name:</label>
        <input type="text" name="platform_name" value="{{ $branding['platform_name'] }}" class="w-full p-2 border dark:bg-gray-700 dark:text-white">

        <label class="block font-semibold mt-2">Primärfarbe:</label>
        <input type="color" name="primary_color" value="{{ $branding['primary_color'] }}" class="w-full p-2 border dark:bg-gray-700 dark:text-white">

        <label class="block font-semibold mt-2">Logo hochladen:</label>
        <input type="file" name="logo" class="block mt-2 p-2 border dark:bg-gray-700 dark:text-white">

        @if($branding['logo'])
            <img src="{{ asset($branding['logo']) }}" alt="Logo" class="h-16 mt-2">
        @endif

        <button type="submit" class="mt-3 p-2 bg-blue-500 text-white rounded">Speichern</button>
    </form>
</div>
@endsection
