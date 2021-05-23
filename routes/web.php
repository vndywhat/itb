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

    Route::group(['prefix' => 'images'], function () {
        Route::get('/', [App\Http\Controllers\ImageController::class, 'index'])->name('images.index');
        Route::post('/', [App\Http\Controllers\ImageController::class, 'store'])->name('images.store');
        Route::get('/create', [App\Http\Controllers\ImageController::class, 'create'])->name('images.create');
        Route::get('/{image}', [App\Http\Controllers\ImageController::class, 'show'])->name('images.show');
    });

    /**
     * in extended cases
     */
    // Route::resource('images', App\Http\Controllers\ImageController::class);
});
