<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use Database\Factories\GenreFactory;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/films/ricerca', [HomeController::class, 'search'])->name('films.search');

Route::get('/contact', function () {
    return view('contact');
})->name('email');

Route::post('/send-email', [EmailController::class, 'sendEmail'])->name('sendEmail');

Route::get('/gestione', function () {
    return view('admin.gestione');
})->name('admin.gestione');


Route::get('/films', [FilmController::class, 'index'])->name('films.index');
Route::get('/films/create', [FilmController::class, 'create'])->name('films.create');
Route::post('/films', [FilmController::class, 'store'])->name('films.store');
Route::get('/films/{id}', [FilmController::class, 'show'])->name('films.show');
Route::get('/films/{id}/edit', [FilmController::class, 'edit'])->name('films.edit');
Route::put('/films/{id}', [FilmController::class, 'update'])->name('films.update');
Route::delete('/films/{id}', [FilmController::class, 'destroy'])->name('films.destroy');





// Rotte per la gestione dei generi
Route::get('/genres', [GenreController::class, 'index'])->name('genres.index');
Route::get('/genres/create', [GenreController::class, 'create'])->name('genres.create');
Route::post('/genres', [GenreController::class, 'store'])->name('genres.store');
Route::get('/genres/{id}', [GenreController::class, 'show'])->name('genres.show');
Route::get('/genres/{id}/edit', [GenreController::class, 'edit'])->name('genres.edit');
Route::put('/genres/{id}', [GenreController::class, 'update'])->name('genres.update');
Route::delete('/genres/{id}', [GenreController::class, 'destroy'])->name('genres.destroy');

// Rotte per la gestione dei registi
Route::get('/directors', [DirectorController::class, 'index'])->name('directors.index');
Route::get('/directors/create', [DirectorController::class, 'create'])->name('directors.create');
Route::post('/directors', [DirectorController::class, 'store'])->name('directors.store');
Route::get('/directors/{id}', [DirectorController::class, 'show'])->name('directors.show');
Route::get('/directors/{id}/edit', [DirectorController::class, 'edit'])->name('directors.edit');
Route::put('/directors/{id}', [DirectorController::class, 'update'])->name('directors.update');
Route::delete('/directors/{id}', [DirectorController::class, 'destroy'])->name('directors.destroy');

// Rotte per la gestione degli attori
Route::get('/actors', [ActorController::class, 'index'])->name('actors.index');
Route::get('/actors/create', [ActorController::class, 'create'])->name('actors.create');
Route::post('/actors', [ActorController::class, 'store'])->name('actors.store');
Route::get('/actors/{id}', [ActorController::class, 'show'])->name('actors.show');
Route::get('/actors/{id}/edit', [ActorController::class, 'edit'])->name('actors.edit');
Route::put('/actors/{id}', [ActorController::class, 'update'])->name('actors.update');
Route::delete('/actors/{id}', [ActorController::class, 'destroy'])->name('actors.destroy');