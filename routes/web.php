<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Pendaftaran;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [HomeController::class, 'welcome']);


Route::resource('/dashboard', HomeController::class)->middleware(['auth'])->names('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/perbarui-password', [HomeController::class, 'perbarui_password'])->middleware(['auth'])->name('perbarui_password');
Route::post('/perbarui-password/updatepw', [HomeController::class, 'updatepw'])->middleware(['auth'])->name('perbaruipassword_new');

Route::resource('/pendaftaran', Pendaftaran::class)->names('pendaftaran');
Route::get('/pendaftaran-lihat', [Pendaftaran::class, 'lihat'])->name('pendaftaran.lihat');

require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';

require __DIR__ . '/auth.php';
