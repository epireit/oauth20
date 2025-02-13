<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  public function register(Request $request)
  {
      // Debugging: Eingabedaten ausgeben
      \Log::info('Register Input:', $request->all());

      $request->validate([
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:users',
          'password' => 'required|string|min:6|confirmed',
      ]);

      // Debugging: Prüfen, ob die Validierung durchläuft
      \Log::info('Validation passed');

      try {
          $user = User::create([
              'name' => $request->name,
              'email' => $request->email,
              'password' => Hash::make($request->password),
          ]);

          // Debugging: Prüfen, ob der User erfolgreich gespeichert wurde
          \Log::info('User created:', ['id' => $user->id]);

          Auth::login($user);

          if ($request->session()->has('oauth_redirect_uri')) {
              $redirectUri = $request->session()->pull('oauth_redirect_uri');
              return redirect()->to($redirectUri . '?token=' . $user->createToken('authToken')->accessToken);
          }

          return redirect()->route('dashboard')->with('success', 'Registrierung erfolgreich!');

      } catch (\Exception $e) {
          \Log::error('User creation failed:', ['error' => $e->getMessage()]);
          return back()->withErrors(['message' => 'Fehler beim Erstellen des Benutzers.'])->withInput();
      }
  }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->withErrors(['email' => 'Die Anmeldedaten sind ungültig.'])->withInput();
        }

        $user = Auth::user();

        // Falls der Nutzer über einen OAuth-Client kommt, redirect zurück zum Client
        if ($request->session()->has('oauth_redirect_uri')) {
            $redirectUri = $request->session()->pull('oauth_redirect_uri');
            return redirect()->to($redirectUri . '?token=' . $user->createToken('authToken')->accessToken);
        }

        return redirect()->route('dashboard')->with('success', 'Login erfolgreich!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Du wurdest erfolgreich ausgeloggt.');
    }

    public function showProfile()
    {
        return view('auth.profile', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil wurde aktualisiert.');
    }
}
