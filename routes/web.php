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
Route::get('/admin/dashboard', function() { return view('admin.index');   })-> name('admin.dashboard');

Route::delete('/loans/{id}', [LoanController::class, 'destroy'])->name('loans.destroy');
Route::get('/admin/loans', [LoanController::class, 'adminIndex'])->name('admin.loans.index');
Route::get('/admin/loans/{id}/edit', [LoanController::class, 'edit'])->name('admin.loans.edit');
Route::get('/admin/loans/create', [LoanController::class, 'create'])->name('admin.loans.create');
Route::put('/admin/loans/{id}', [LoanController::class, 'update'])->name('admin.loans.update');
//ro rescr for crud tool
    
});

//ro midl([aut, 'role:']) ->group(func(){  })
Route::middleware(['auth', 'role:petugas'])->group(function () {

//ro get (role das, func () {ret viw(role.i); })->name rol das
Route::get('/petugas/dashboard', [LoanController::class, 'petugasIndex']) -> name('petugas.dashboard');
Route::get('/petugas/report', [LoanController::class, 'report'])->name('petugas.report');
});

Route::middleware(['auth'])->group(function () {
    
    // cek role in contr 
    Route::put('/loans/return/{id}', [LoanController::class, 'returnTool'])->name('loans.return');
    Route::put('/loans/approve/{id}', [LoanController::class, 'approve'])->name('loans.approve');
    Route::post('/pinjam.store', [LoanController::class, 'store'])->name('pinjam.store');
});

//ro midl([aut, 'role:']) ->group(func(){  })
Route::middleware(['auth', 'role:peminjam'])->group(function () {

//ro get (role das, func () {ret viw(role.i); })->name rol das
    Route::get('/peminjam/dashboard', [LoanController::class, 'peminjamIndex'])->name('peminjam.dashboard');
    Route::post('/pinjam', [LoanController::class, 'store'])->name('pinjam.store');

});

  

