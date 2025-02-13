@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold">Willkommen, {{ auth()->user()->name }}!</h2>
    <p>Du bist erfolgreich eingeloggt.</p>
    <a href="{{ route('logout') }}" class="text-red-500 mt-4 inline-block">Logout</a>
</div>
@endsection
