<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
     public function boot()
   {
       $theme = config('app.active_theme', 'default');
       $themePath = resource_path('themes/' . $theme);
       $adminPath = resource_path('views/');

       if (is_dir($themePath)) {
           // Setze das Theme als Standard-View-Pfad
           View::getFinder()->setPaths([$themePath]);

           // Registriere das Theme mit dem Namespace "theme"
           View::addNamespace('theme', $themePath);

           Log::info("Theme erfolgreich als Hauptpfad gesetzt: " . $themePath);
       } else {
           Log::error("Theme-Pfad nicht gefunden: " . $themePath);
       }

       if (is_dir($adminPath)) {
           // Stelle sicher, dass Laravel alle Admin-Views im richtigen Pfad sucht
           //View::prependNamespace('admin', $adminPath);
           View::addNamespace('admin', $adminPath);
           View::addLocation($adminPath);

           Log::info("Admin Panel Path registriert: " . $adminPath);
       } else {
           Log::error("Admin Panel-Pfad nicht gefunden: " . $adminPath);
       }
   }


    /**
     * Register services.
     */
    public function register()
    {
        //
    }
}
