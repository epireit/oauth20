@extends('theme::layouts.main')

@section('title', 'Mein Profil')

@section('content')
<div class="text-center mb-6">
    <img src="{{ asset(config('branding.logo')) }}" alt="Logo" class="h-16 mx-auto">
</div>

<div class="bg-white p-8 rounded-lg shadow-md max-w-lg mx-auto">
    <h2 class="text-2xl font-bold mb-4">Mein Profil</h2>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded-lg text-center mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile') }}">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Neues Passwort (optional)</label>
            <input type="password" id="password" name="password"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Passwort bestätigen</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
            Profil speichern
        </button>
    </form>
</div>
@endsection
