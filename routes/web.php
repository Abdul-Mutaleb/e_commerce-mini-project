<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AdminController, HomeController, ProfileController, UserController};

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [HomeController::class, 'index']);
Route::get('/dashboard', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

//Admin controller 

// category get route 
Route::get('/Admin/addCategory', [AdminController::class, 'category'])->middleware(['auth', 'verified'])->name('Admin.addCategory');
Route::get('/Admin/categoryList', [AdminController::class, 'categoryList'])->middleware(['auth', 'verified'])->name('Admin.categoryList');
Route::get('/Admin/editCategory/{id}', [AdminController::class, 'editCategory'])->middleware(['auth', 'verified'])->name('Admin.editCategory');

// category post & put route 
Route::post('/Admin/addCategory', [AdminController::class, 'addCategory'])->middleware(['auth', 'verified'])->name('Admin.addCategory');
Route::put('/Admin/updateCategory/{id}', [AdminController::class, 'updateCategory'])->middleware(['auth', 'verified'])->name('Admin.updateCategory');

// category delete route 
Route::delete('deleteCategory/{id}', [AdminController::class, 'deleteCategory'])->middleware(['auth', 'verified'])->name('Admin.deleteCategory');

//Product handle 

//Product get route
Route::get('/Admin/addProduct', [AdminController::class, 'product'])->middleware(['auth', 'verified'])->name('Admin.addProduct');
Route::get('/Admin/productList', [AdminController::class, 'productList'])->middleware(['auth', 'verified'])->name('Admin.productList');
Route::get('/Admin/editProduct/{id}', [AdminController::class, 'editProduct'])->middleware(['auth', 'verified'])->name('Admin.editProduct');

// product post & put route
Route::post('/Admin/addProduct', [AdminController::class, 'addProduct'])->middleware(['auth', 'verified'])->name('Admin.addProduct');
Route::put('/Admin/updateProduct/{id}', [AdminController::class, 'updateProduct'])
    ->name('Admin.updateProduct');

//product delete route 
Route::delete('/deleteProduct/{id}', [AdminController::class, 'deleteProduct'])->middleware(['auth', 'verified'])->name('Admin.deleteProduct');
Route::delete('/Admin/deleteProductImage/{id}', [AdminController::class, 'deleteProductImage'])->middleware(['auth', 'verified'])->name('Admin.deleteProductImage');