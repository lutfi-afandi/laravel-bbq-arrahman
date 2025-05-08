<?php

use App\Http\Controllers\Admin\CetakController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InformasiController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\KelompokController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PesertaController;
use App\Http\Controllers\Admin\TutorController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Peserta\DashboardController as PesertaDashboardController;
use App\Http\Controllers\Tutor\AbsenController;
use App\Http\Controllers\Tutor\DashboardController as TutorDashboardController;
use App\Http\Controllers\Tutor\JadwalController as TutorJadwalController;
use App\Http\Controllers\Tutor\LaporanController as TutorLaporanController;
use App\Http\Controllers\Tutor\NilaiController;

Route::middleware(['is_admin'])->group(function () {
  Route::resource('/admin/peserta', PesertaController::class)->names('admin.peserta');
  Route::get('/admin/peserta-kbm', [PesertaController::class, 'kbm'])->name('admin.peserta.kbm');
  Route::put('/admin/peserta/keterangan/{id}', [PesertaController::class, 'keterangan'])->name('admin.peserta.keterangan');

  Route::put('/admin/tutor-reset/{tutor}', [TutorController::class, 'reset'])->name('admin.tutor.reset');
  Route::resource('/admin/tutor', TutorController::class)->names('admin.tutor');

  Route::resource('/admin/jadwal', JadwalController::class)->names('admin.jadwal');

  Route::resource('/admin/kelompok', KelompokController::class)->names('admin.kelompok');

  Route::put('/admin/informasi-status/{id}', [InformasiController::class, 'status'])->name('admin.informasi.status');
  Route::put('/admin/informasi-masa/{id}', [InformasiController::class, 'masa'])->name('admin.informasi.masa');
  Route::put('/admin/informasi-agenda/{id}', [InformasiController::class, 'agenda'])->name('admin.informasi.agenda');
  Route::put('/admin/informasi-biaya/{id}', [InformasiController::class, 'biaya'])->name('admin.informasi.biaya');
  Route::put('/admin/informasi-pamflet/{id}', [InformasiController::class, 'pamflet'])->name('admin.informasi.pamflet');
  Route::put('/admin/informasi-narahubung/{id}', [InformasiController::class, 'narahubung'])->name('admin.informasi.narahubung');
  Route::resource('/admin/informasi', InformasiController::class)->names('admin.informasi');

  Route::resource('/admin/kegiatan', KegiatanController::class)->names('admin.kegiatan');

  Route::put('/admin/user-reset/{user}', [UserController::class, 'reset'])->name('admin.user.reset');
  Route::resource('/admin/user', UserController::class)->names('admin.user');

  Route::get('/admin/dashboard/grafikJk', [DashboardController::class, 'grafikJk']);
  Route::get('/admin/dashboard/grafikJurusan', [DashboardController::class, 'grafikJurusan']);
  Route::resource('/admin/dashboard', DashboardController::class)->names('admin.dashboard');
  Route::resource('/admin/laporan', LaporanController::class)->names('admin.laporan');

  Route::get('/admin/cetak', [CetakController::class, 'index'])->name('admin.cetak.index');
  Route::get('/admin/exportMahasiswa', [CetakController::class, 'exportMahasiswa']);
  Route::get('/admin/exportKelompok', [CetakController::class, 'exportKelompok']);
  Route::get('/admin/exportTutor', [CetakController::class, 'exportTutor']);
});


Route::middleware(['is_tutor'])->group(function () {
  Route::resource('/tutor/dashboard', TutorDashboardController::class)->names('tutor.dashboard');
  Route::resource('/tutor/jadwal', TutorJadwalController::class)->names('tutor.jadwal');
  Route::resource('/tutor/absen', AbsenController::class)->names('tutor.absen');
  Route::resource('/tutor/nilai', NilaiController::class)->names('tutor.nilai');
  Route::resource('/tutor/laporan', TutorLaporanController::class)->names('tutor.laporan');
});

Route::middleware(['is_mahasiswa'])->group(function () {
  Route::resource('/peserta/dashboard', PesertaDashboardController::class)->names('peserta.dashboard');
});
