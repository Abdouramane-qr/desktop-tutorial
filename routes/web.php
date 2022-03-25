<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\StockController;
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
// Route::get('/fournisseur-view',[fournisseurControlleur::class, 'index'])->name('fournisseur.view');


Route::post('/article-store',[ArticleController::class, 'store'])->name('article.store');
Route::delete('/articles-destroy/{id}',[ArticleController::class, 'destroy'])->name('articles.destroy');
Route::get('/article-edit/{id}',[ArticleController::class, 'edit'])->name('articles.edit');
Route::get('/article-show/{id}',[ArticleController::class, 'show'])->name('articles.show');
Route::put('/article-update/{id}',[ArticleController::class, 'update'])->name('articles.update');




Route::post('/client-store',[ClientController::class, 'store'])->name('client.store');
Route::post('/commande-store',[CommandeController::class, 'store'])->name('commande.store');
Route::delete('/client-destroy/{id}',[ClientController::class, 'destroy'])->name('client.destroy');
Route::get('/commande-show/{id}/',[CommandeController::class, 'show'])->name('commande.show');
Route::get('/client-edit',[ClientController::class, 'edit'])->name('client.edit');
Route::get('/clients-edit',[ClientController::class,'edit'])->name('clients.edit');




Route::get('generate-pdf', [CommandeController::class, 'download'])->name('generate-pdf');


Route::resource('fournisseurs', FournisseurController::class);

Route::resource('depenses',DepenseController::class);

 // Stocks
    //Route::delete('stocks/destroy', 'StocksController@massDestroy')->name('stocks.massDestroy');
    Route::resource('stocks',  StockController::class);
 


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
