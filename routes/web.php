<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommandeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/article-view',[ArticleController::class,'index'])->name('article.view');
Route::get('/client-view',[ClientController::class,'index'])->name('client.view');
Route::get('/commande-view',[CommandeController::class, 'index'])->name('commande.view');
Route::get('/fournisseur-view',[fournisseurControlleur::class, 'index'])->name('forunisseur.view');


Route::post('/article-store',[ArticleController::class, 'store'])->name('article.store');
Route::post('/client-store',[ClientController::class, 'store'])->name('client.store');
Route::post('/commande-store',[CommandeController::class, 'store'])->name('commande.store');
Route::post('/fournisseur-store',[fournisseurControlleur::class, 'store'])->name('fournisseur.store');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
