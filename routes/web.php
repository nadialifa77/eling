<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\CeritaController;
use App\Http\Controllers\JejakController;
use App\Http\Controllers\TujuanController;
use App\Http\Controllers\VersionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pengembang', function () {
    return view('pengembang');
})->name('pengembang');

require __DIR__ . '/auth.php';
Route::middleware('auth')->group(function () {
    Route::controller(BerandaController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });

    Route::controller(VersionController::class)->group(function () {
        Route::get('/versi', 'index')->name('versi');
        Route::post('/versi', 'store')->name('versi.store');
    });
    Route::controller(CeritaController::class)->group(function () {
        Route::get('/cerita', 'index')->name('cerita');
        Route::post('/cerita', 'store')->name('cerita.store');
        Route::delete('/cerita/{id}', 'destroy')->name('cerita.destroy');
    });

    Route::get('/profil', function () {
        return view('profil');})
    ->name('profile.show');

    Route::controller(TujuanController::class)->group(function () {
        Route::get('/tujuan', 'index')->name('tujuan');
        Route::post('/tujuan', 'store')->name('tujuan.store');
        Route::post('/sub', 'addSub')->name('sub.store');
        Route::post('/sub/{id}', 'toggle')->name('sub.toggle');
        Route::delete('/tujuan/{id}', 'destroy')->name('tujuan.delete');
        Route::delete('/sub/{id}', 'deleteSub')->name('sub.delete');
    });

    Route::controller(JejakController::class)->group(function () {
        Route::get('/jejak', 'index')->name('jejak');
    });
});
