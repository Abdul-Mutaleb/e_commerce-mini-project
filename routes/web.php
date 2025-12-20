<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AdminController, ProfileController, UserController};

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',[UserController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//Admin controller 

//Product handle 
Route::get('/Admin/product',[AdminController::class,'product'])->middleware(['auth', 'verified'])->name('Admin.product');

// category get route 
Route::get('/Admin/category',[AdminController::class,'category'])->middleware(['auth', 'verified'])->name('Admin.category');
Route::get('/Admin/categoryList',[AdminController::class,'categoryList'])->middleware(['auth', 'verified'])->name('Admin.categoryList');
Route::get('/Admin/editCategory/{id}',[AdminController::class,'editCategory'])->middleware(['auth', 'verified'])->name('Admin.editCategory');


// category post & put route 
Route::post('/Admin/category',[AdminController::class,'addCategory'])->middleware(['auth', 'verified'])->name('Admin.category');
Route::put('/Admin/updateCategory/{id}',[AdminController::class,'updateCategory'])->middleware(['auth', 'verified'])->name('Admin.updateCategory');

// category delete route 
Route::delete('deleteCategory/{id}',[AdminController::class,'deleteCategory'])->middleware(['auth', 'verified'])->name('Admin.deleteCategory');