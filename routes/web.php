<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BureauController;
use App\Http\Controllers\SiegeController;
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

Auth::routes();
Route::middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // articles
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles/create', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    // bureau 
    Route::get('/bureaux', [BureauController::class, 'index'])->name('bureaux.index');
    Route::get('/bureaux/create', [BureauController::class, 'create'])->name('bureaux.create');
    Route::post('/bureaux/create', [BureauController::class, 'store'])->name('bureaux.store');
    Route::get('/bureaux/{id}/edit', [BureauController::class, 'edit'])->name('bureaux.edit');
    Route::put('/bureaux/{id}', [BureauController::class, 'update'])->name('bureaux.update');
    Route::delete('/bureaux/{id}', [BureauController::class, 'destroy'])->name('bureaux.destroy');
    // Add a new route for sieges
    Route::get('/sieges', [SiegeController::class, 'index'])->name('sieges.index');
    Route::get('/sieges/create', [SiegeController::class, 'create'])->name('sieges.create');
    Route::post('/sieges/create', [SiegeController::class, 'store'])->name('sieges.store');
    Route::get('/sieges/{id}/edit', [SiegeController::class, 'edit'])->name('sieges.edit');
    Route::put('/sieges/{id}', [SiegeController::class, 'update'])->name('sieges.update');
    Route::delete('/sieges/{id}', [SiegeController::class, 'destroy'])->name('sieges.destroy');
});
