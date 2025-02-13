<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function branding()
    {
        $branding = config('branding');
        return view('admin.settings.branding', compact('branding'));
    }

    public function updateBranding(Request $request)
    {
        $request->validate([
            'platform_name' => 'required|string|max:255',
            'primary_color' => 'required|string|max:7',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        // Branding-Daten speichern
        $branding = [
            'platform_name' => $request->input('platform_name'),
            'primary_color' => $request->input('primary_color'),
        ];

        // Falls ein Logo hochgeladen wurde
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->storeAs('public', 'branding_logo.png');
            $branding['logo'] = 'storage/branding_logo.png';
        } else {
            $branding['logo'] = config('branding.logo');
        }

        // Branding-Daten in die Config-Datei schreiben
        file_put_contents(config_path('branding.php'), "<?php return " . var_export($branding, true) . ";");

        return redirect()->route('admin.branding')->with('success', 'Branding-Einstellungen gespeichert!');
    }
}
