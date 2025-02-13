@extends('admin.layouts.app')

@section('title', 'Benutzer bearbeiten')

@section('content')
<div class="bg-white dark:bg-gray-800 p-6 rounded shadow-md">
    <h1 class="text-xl font-bold mb-4">Benutzer bearbeiten</h1>
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        <label class="block">Name:</label>
        <input type="text" name="name" value="{{ $user->name }}" class="w-full p-2 border dark:bg-gray-700 dark:text-white">

        <label class="block mt-2">E-Mail:</label>
        <input type="email" name="email" value="{{ $user->email }}" class="w-full p-2 border dark:bg-gray-700 dark:text-white">

        <button type="submit" class="mt-3 p-2 bg-blue-500 text-white rounded">Speichern</button>
    </form>
</div>
@endsection
