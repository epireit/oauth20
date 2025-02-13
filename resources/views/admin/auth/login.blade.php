@extends('admin.layouts.app')

@section('title', 'Admin Login')

@section('content')
<div class="bg-white dark:bg-gray-800 p-6 rounded shadow-md max-w-md mx-auto">
    <h1 class="text-xl font-bold mb-4">Admin Login</h1>
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <label class="block">E-Mail:</label>
        <input type="email" name="email" class="w-full p-2 border dark:bg-gray-700 dark:text-white">
        <label class="block mt-2">Passwort:</label>
        <input type="password" name="password" class="w-full p-2 border dark:bg-gray-700 dark:text-white">
        <button type="submit" class="mt-3 p-2 bg-blue-500 text-white rounded">Login</button>
    </form>
</div>
@endsection
