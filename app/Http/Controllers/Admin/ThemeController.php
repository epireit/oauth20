<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ThemeController extends Controller
{
    public function index()
    {
        $themes = File::directories(resource_path('themes'));
        $activeTheme = config('theme.active');
        return view('admin.themes.index', compact('themes', 'activeTheme'));
    }

    public function activate($theme)
    {
        file_put_contents(config_path('theme.php'), "<?php return ['active' => '$theme'];");
        return redirect()->route('admin.themes')->with('success', 'Theme aktiviert!');
    }

    public function upload(Request $request)
    {
        $request->validate(['theme' => 'required|file|mimes:zip']);

        $zip = $request->file('theme');
        $themeName = pathinfo($zip->getClientOriginalName(), PATHINFO_FILENAME);
        $themePath = resource_path("themes/$themeName");

        // Entpacke das hochgeladene Theme
        $zip->move(storage_path('app/temp'), 'theme.zip');
        $zipArchive = new \ZipArchive;
        if ($zipArchive->open(storage_path('app/temp/theme.zip')) === TRUE) {
            $zipArchive->extractTo($themePath);
            $zipArchive->close();
            File::delete(storage_path('app/temp/theme.zip'));
        }

        return redirect()->route('admin.themes')->with('success', 'Theme hochgeladen!');
    }

    public function delete($theme)
    {
        File::deleteDirectory(resource_path("themes/$theme"));
        return redirect()->route('admin.themes')->with('success', 'Theme gelöscht!');
    }
}
