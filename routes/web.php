<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\siswaController;

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
        return view('welcome');
    });

    Route::get('/app', function () {
        return view('layouts.app');
    });

    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/siswa', [siswaController::class, 'index'])->name('siswa');
    Route::post('/siswa/create/success', [siswaController::class, 'store'])->name('siswa.store');
    Route::get('/siswa/delete/success/{id}', [siswaController::class, 'destroy'])->name('siswa.delete');
    Route::get('/siswa/update/success/{id}', [siswaController::class, 'update'])->name('siswa.update');
?>