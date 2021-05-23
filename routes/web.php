<?php

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

Auth::routes(['verify' => true]);

Route::group(['middleware' => 'verified'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'gallery'], function () {
        Route::get('/', [App\Http\Controllers\GalleryController::class, 'index'])->name('gallery.index');
        Route::post('/', [App\Http\Controllers\GalleryController::class, 'store'])->name('gallery.store');
        Route::get('/create', [App\Http\Controllers\GalleryController::class, 'create'])->name('gallery.create');
        Route::get('/{image}', [App\Http\Controllers\GalleryController::class, 'show'])->name('gallery.show');
        Route::get('/user/{user}', [App\Http\Controllers\GalleryController::class, 'userImages'])->name('gallery.user');
    });

    /**
     * in extended cases
     */
    // Route::resource('images', App\Http\Controllers\ImageController::class);
});
