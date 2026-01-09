<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\ToolController;      // Tambahkan ini
use App\Http\Controllers\CategoryController;  // Tambahkan ini

//route get [authc class] -> name
Route::get('/', [authController::class, 'showlogin']) -> name('login');
Route::post('/login', [authController::class, 'login']) -> name('login.post');
Route::post('/logout', [authController::class, 'logout']) -> name('logout');

//ro midl([aut, 'role:']) ->group(func(){  })
Route::middleware(['auth', 'role:admin'])->group(function () {
Route::resource('tools', ToolController::class);
    Route::resource('category', CategoryController::class);
//ro get (role das, func () {ret viw(role.i); })->name rol das
    Route::get('/admin/dashboard', function() {
return view('admin.index');
    })-> name('admin.dashboard');
//ro rescr for crud tool
    
});

//ro midl([aut, 'role:']) ->group(func(){  })
Route::middleware(['auth', 'role:petugas'])->group(function () {
//ro get (role das, func () {ret viw(role.i); })->name rol das
    Route::get('/petugas/dashboard', function() {return view('petugas.index');}) -> name('petugas.dashboard');
});

//ro midl([aut, 'role:']) ->group(func(){  })
Route::middleware(['auth', 'role:peminjam'])->group(function () {
//ro get (role das, func () {ret viw(role.i); })->name rol das
    Route::get('/peminjam/dashboard', function() {return view('peminjam.index');}) -> name('peminjam.dashboard');
});

  

