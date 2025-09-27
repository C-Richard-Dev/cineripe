<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MovieController::class, 'index'])->name('home');

/**
 * Gerenciamento de Filmes
 */
Route::prefix('movie')->group(function () {
    Route::get('/details/{movie}', [MovieController::class, 'details'])->name('movie.details'); // exibe detalhes de um filme
    Route::get('/movies/search', [MovieController::class, 'search'])->name('movies.search');
});

// Rotas protegidas por autenticação
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Avaliação de filmes
    Route::prefix('ratings')->group(function () {
        Route::post('/rate/{movie}', [RatingController::class, 'store'])->name('rate.store'); // avalia um filme (usuários autenticados)
        Route::delete('/destroy/{rating}', [RatingController::class, 'destroy'])->name('rate.destroy'); // apaga avaliação
        Route::put('/update/{rating}', [RatingController::class, 'update'])->name('rate.update'); // edita avaliação
    });
    /**
     * Somente usuários do tipo Admin
     */
    Route::middleware('auth', 'admin')->group(function(){
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // apaga um perfil
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard'); // redireciona para dashboard
    });
});

require __DIR__.'/auth.php';
