<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Peserta\DashboardController as PesertaDashboardController;
use App\Http\Controllers\Tutor\DashboardController as TutorDashboardController;

Route::middleware(['is_admin'])->group(function () {
  Route::resource('/admin/dashboard', DashboardController::class)->names('admin.dashboard');
});


Route::middleware(['is_tutor'])->group(function () {
  Route::resource('/tutor/dashboard', TutorDashboardController::class)->names('tutor.dashboard');
});

Route::middleware(['is_peserta'])->group(function () {
  Route::resource('/peserta/dashboard', PesertaDashboardController::class)->names('peserta.dashboard');
});
