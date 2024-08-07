<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DaftarmahasiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/jalur', function () {
    return view('jalur');
});

Route::get('/alur', function () {
    return view('alur');
});

Route::get('/biaya', function () {
    return view('biaya');
});

Route::get('/daftarmahasiswa', [DaftarmahasiswaController::class, 'index'])->name('daftarmahasiswa.index');
Route::get('/daftarmahasiswa/create', [DaftarmahasiswaController::class, 'create'])->name('daftarmahasiswa.create');
Route::post('/daftarmahasiswa', [DaftarmahasiswaController::class, 'store'])->name('daftarmahasiswa.store');
Route::get('/daftarmahasiswa/{id}/edit', [DaftarmahasiswaController::class, 'edit'])->name('daftarmahasiswa.edit');
Route::put('/daftarmahasiswa/{id}', [DaftarmahasiswaController::class, 'update'])->name('daftarmahasiswa.update');

Route::get('/pengumuman', [PengumumanController::class,'index']);
Route::get('/pengumuman/create', [PengumumanController::class,'create']);
Route::post('/pengumuman/store', [PengumumanController::class,'store']);
Route::get('/pengumuman/{id}/edit', [PengumumanController::class,'edit']);
Route::put('/pengumuman/{id}', [PengumumanController::class,'update']);
Route::delete('/pengumuman/{id}', [PengumumanController::class,'destroy']);

Route::get('/navbar', function () {
    return view('layout/navbar');
});
Auth::routes();

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('role:admin');
    Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard')->middleware('role:mahasiswa');
});

Route::get('/not-verified', function () {
    return "Your account is not verified.";
});

Route::patch('/admin/verify/{id}', [AdminController::class, 'verify'])->name('admin.verify');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
