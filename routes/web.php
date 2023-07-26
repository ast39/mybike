<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Client;
use App\Http\Controllers\Bikes;
use App\Http\Controllers\Services;
use App\Http\Controllers\Articles;
use App\Http\Controllers\Notes;

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

Route::get('/', function () {
    return redirect('/client');
});

# Раздел клиента
Route::group(['prefix' => 'client', 'middleware' => ['auth']], function () {
    Route::get('', [Client::class, 'index'])->name('client.index');
    Route::get('{id}', [Client::class, 'show'])->name('client.show');
    Route::get('edit/{id}', [Client::class, 'edit'])->name('client.edit');
    Route::put('{id}', [Client::class, 'update'])->name('client.update');
});

# Раздел мотоциклов
Route::group(['prefix' => 'bikes', 'middleware' => ['auth']], function () {

    Route::get('', [Bikes::class, 'index'])->name('bike.index');
    Route::get('create', [Bikes::class, 'create'])->name('bike.create');
    Route::post('', [Bikes::class, 'store'])->name('bike.store');
    Route::get('{id}', [Bikes::class, 'show'])->name('bike.show');
    Route::get('{id}/edit', [Bikes::class, 'edit'])->name('bike.edit');
    Route::put('{id}', [Bikes::class, 'update'])->name('bike.update');
    Route::delete('{id}', [Bikes::class, 'destroy'])->name('bike.destroy');
});

# Раздел обслуживания
Route::group(['prefix' => 'service', 'middleware' => ['auth']], function () {

    Route::get('', [Services::class, 'index'])->name('service.index');
    Route::get('create', [Services::class, 'create'])->name('service.create');
    Route::post('', [Services::class, 'store'])->name('service.store');
    Route::get('{id}', [Services::class, 'show'])->name('service.show');
    Route::get('{id}/edit', [Services::class, 'edit'])->name('service.edit');
    Route::put('{id}', [Services::class, 'update'])->name('service.update');
    Route::delete('{id}', [Services::class, 'destroy'])->name('service.destroy');
});

# Раздел запчастей
Route::group(['prefix' => 'articles', 'middleware' => ['auth']], function () {

    Route::get('', [Articles::class, 'index'])->name('article.index');
    Route::get('create', [Articles::class, 'create'])->name('article.create');
    Route::post('', [Articles::class, 'store'])->name('article.store');
    Route::get('{id}', [Articles::class, 'show'])->name('article.show');
    Route::get('{id}/edit', [Articles::class, 'edit'])->name('article.edit');
    Route::put('{id}', [Articles::class, 'update'])->name('article.update');
    Route::delete('{id}', [Articles::class, 'destroy'])->name('article.destroy');
});

# Раздел заметок
Route::group(['prefix' => 'notes', 'middleware' => ['auth']], function () {

    Route::get('', [Notes::class, 'index'])->name('note.index');
    Route::get('create', [Notes::class, 'create'])->name('note.create');
    Route::post('', [Notes::class, 'store'])->name('note.store');
    Route::get('{id}', [Notes::class, 'show'])->name('note.show');
    Route::get('{id}/edit', [Notes::class, 'edit'])->name('note.edit');
    Route::put('{id}', [Notes::class, 'update'])->name('note.update');
    Route::delete('{id}', [Notes::class, 'destroy'])->name('note.destroy');
});


Auth::routes();
