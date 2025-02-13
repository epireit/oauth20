<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['message' => 'Fehler beim Social Login.']);
        }

        // Überprüfen, ob der Nutzer bereits existiert
        $user = User::where('email', $socialUser->getEmail())->first();

        if (!$user) {
            // Falls der Nutzer nicht existiert, erstellen wir einen neuen Account
            $user = User::create([
                'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                'email' => $socialUser->getEmail(),
                'password' => Hash::make(str()->random(16)), // Zufälliges Passwort setzen
            ]);
        }

        Auth::login($user);

        // Falls der Login über einen OAuth-Client erfolgte, redirect zur App mit Token
        if (session()->has('oauth_redirect_uri')) {
            $redirectUri = session()->pull('oauth_redirect_uri');
            return redirect()->to($redirectUri . '?token=' . $user->createToken('authToken')->accessToken);
        }

        // Falls der Login direkt auf dem Server erfolgte, redirect zur Profilseite
        return redirect()->route('profile')->with('success', 'Erfolgreich angemeldet!');
    }
}
