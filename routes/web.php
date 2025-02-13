<?php

use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;
use App\Http\Controllers\SocialAuthController;
//AdminPanel
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\Admin\SettingController;

Route::get('/', function () {
    return view('welcome');
});
//dd(resource_path('themes/' . config('app.active_theme') . '/layouts/app.blade.php'));
//dd(view()->exists('themes.default.layouts.app'));


//  User Login/Register
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/profile', [AuthController::class, 'showProfile'])->middleware('auth')->name('profile');
Route::post('/profile', [AuthController::class, 'updateProfile'])->middleware('auth');


// Social
Route::get('/auth/{provider}', [SocialAuthController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback']);

//AdminPanel
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        //Users
        Route::get('/users', [UserController::class, 'index'])->name('admin.users');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::post('/users/{id}/update', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{id}/delete', [UserController::class, 'destroy'])->name('admin.users.delete');
        //Themes
        Route::get('/themes', [ThemeController::class, 'index'])->name('admin.themes');
        Route::post('/themes/activate/{theme}', [ThemeController::class, 'activate'])->name('admin.themes.activate');
        Route::post('/themes/upload', [ThemeController::class, 'upload'])->name('admin.themes.upload');
        Route::delete('/themes/delete/{theme}', [ThemeController::class, 'delete'])->name('admin.themes.delete');
        //Branding, SEO
        Route::get('/branding', [SettingController::class, 'branding'])->name('admin.branding');
        Route::post('/branding/update', [SettingController::class, 'updateBranding'])->name('admin.branding.update');
    });
});


// Debug
Route::get('/debug-views', function () {
    return response()->json(View::getFinder()->getPaths());
});
Route::get('/test-theme', function () {
    return view('test');
});
Route::get('/check-layout', function () {
    return view()->exists('layouts.main') ? '✅ Layout gefunden' : '❌ Layout nicht gefunden';
});
Route::get('/debug-app-view', function () {
    return response()->json(View::getFinder()->find('layouts.main'));
});
Route::get('/debug-layout-paths', function () {
    return response()->json(View::getFinder()->getPaths());
});



Route::get('/debug-admin-paths', function () {
    return response()->json(View::getFinder()->getPaths());
});

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
