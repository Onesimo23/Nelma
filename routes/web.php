<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\TwoFactorAuthController;
use App\Http\Controllers\Auth\SettingsController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\Auth\GithubController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SensitiveDataController;
use App\Models\Log;


// Rota para a página de login (tela inicial)
Route::get('/', function () {
    return view('auth.login');
})->name('login');

// Rotas de autenticação com GitHub
Route::get('/auth/github', [GithubController::class, 'redirectToGithub'])->name('auth.github');
Route::get('/auth/github/callback', [GithubController::class, 'handleGithubCallback'])->name('auth.github.callback');

// Rotas de produtos
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Rota para sensitive data (dados sensíveis)
Route::resource('sensitive_data', SensitiveDataController::class);

// Rotas de dashboard e perfil, protegidas por autenticação
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/logs', function () {
    $logs = Log::all();
    return view('logs.index', compact('logs'));
});

require __DIR__.'/auth.php';
