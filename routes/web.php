<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\ToolController;      
use App\Http\Controllers\CategoryController;  
use App\Http\Controllers\LoanController;  
use App\Http\Controllers\UserController;

//route get [authc class] -> name
Route::get('/', [authController::class, 'showlogin']) -> name('login');
Route::get('/signup', [authController::class, 'signup']) -> name('signup');
Route::post('/login', [authController::class, 'login']) -> name('login.post');
Route::post('/signupacc', [authController::class, 'signupacc']) -> name('signupacc.post');
Route::post('/logout', [authController::class, 'logout']) -> name('logout');

//ro midl([aut, 'role:']) ->group(func(){  })
Route::middleware(['auth', 'role:admin'])->group(function () {
Route::resource('tools', ToolController::class);
Route::resource('users', UserController::class); 
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
    Route::get('/petugas/dashboard', [LoanController::class, 'petugasIndex']) -> name('petugas.dashboard');
Route::put('/loans/return/{id}', [LoanController::class, 'returnTool'])->name('loans.return');
Route::put('/loans/approve/{id}', [LoanController::class, 'approve'])->name('loans.approve');
Route::get('/petugas/report', [LoanController::class, 'report'])->name('petugas.report');
});

//ro midl([aut, 'role:']) ->group(func(){  })
Route::middleware(['auth', 'role:peminjam'])->group(function () {
//ro get (role das, func () {ret viw(role.i); })->name rol das
    Route::get('/peminjam/dashboard', [LoanController::class, 'peminjamIndex'])->name('peminjam.dashboard');
Route::post('/pinjam', [LoanController::class, 'store'])->name('pinjam.store');

});

  

