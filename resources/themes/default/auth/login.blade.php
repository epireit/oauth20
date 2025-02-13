@extends('theme::layouts.main')

@section('content')
<div class="text-center mb-6">
    <img src="{{ asset(config('branding.logo')) }}" alt="Logo" class="h-16 mx-auto">
</div>

<div class="flex justify-center items-center h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-700">Login</h2>

        <form method="POST" action="{{ route('login') }}" class="mt-6">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Passwort</label>
                <div class="relative">
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                        👁️
                    </button>
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
                Einloggen
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('register') }}" class="text-blue-500">Noch kein Account? Registrieren</a>
        </div>

        <div class="mt-6">
            @if(env('GOOGLE_CLIENT_ID') || env('FACEBOOK_CLIENT_ID') || env('APPLE_CLIENT_ID') || env('TWITTER_CLIENT_ID') || env('DISCORD_CLIENT_ID'))
            <h3 class="text-sm font-medium text-gray-700">Oder mit Social Login</h3>
            @endif
            <div class="flex flex-col gap-2 mt-3">
                @if(env('GOOGLE_CLIENT_ID'))
                <a href="{{ url('/auth/google') }}" class="flex items-center justify-center bg-red-500 text-white py-2 rounded-lg hover:bg-red-600">
                    Google Login
                </a>
                @endif

                @if(env('FACEBOOK_CLIENT_ID'))
                <a href="{{ url('/auth/facebook') }}" class="flex items-center justify-center bg-blue-700 text-white py-2 rounded-lg hover:bg-blue-800">
                    Facebook Login
                </a>
                @endif

                @if(env('APPLE_CLIENT_ID'))
                <a href="{{ url('/auth/apple') }}" class="flex items-center justify-center bg-gray-900 text-white py-2 rounded-lg hover:bg-gray-800">
                    Apple Login
                </a>
                @endif

                @if(env('TWITTER_CLIENT_ID'))
                <a href="{{ url('/auth/twitter') }}" class="flex items-center justify-center bg-blue-400 text-white py-2 rounded-lg hover:bg-blue-500">
                    Twitter Login
                </a>
                @endif

                @if(env('DISCORD_CLIENT_ID'))
                <a href="{{ url('/auth/discord') }}" class="flex items-center justify-center bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700">
                    Discord Login
                </a>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    var pass = document.getElementById("password");
    if (pass.type === "password") {
        pass.type = "text";
    } else {
        pass.type = "password";
    }
}
</script>
@endsection
