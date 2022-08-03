<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});
//auth route
Route::group(['middleware'=> ['auth']], function (){
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
});

//for admin
Route::group(['middleware'=> ['auth', 'role:admin']], function (){
    Route::get('/dashboard/add-category', [CategoryController::class, 'add'])->name('dashboard.addCategory');
    Route::post('/dashboard/add-category', [CategoryController::class, 'store'])->name('dashboard.storeCategory');
    Route::get('/dashboard/delete-category/{id}', [CategoryController::class, 'delete']);
    Route::get('/dashboard/accDelete-category/{id}', [CategoryController::class, 'accDelete']);
    Route::get('/dashboard/edit-category/{id}', [CategoryController::class, 'edit']);
    Route::put('/dashboard/accEdit-category/{id}', [CategoryController::class, 'accEdit']);
    Route::get('/dashboard/list-products', [ProductController::class, 'listAllForAdmin'])->name('dashboard.listProduct');
    Route::get('/dashboard/list-products/product-details/{id}', [ProductController::class, 'productDetails']);
    Route::post('/dashboard/list-products/search', [ProductController::class, 'search'])->name('dashboard.search');

    Route::get('/dashboard/my-products/admin/delete-product/{id}', [ProductController::class, 'deleteProduct']);



});

//for seller
Route::group(['middleware'=> ['auth', 'role:seller']], function (){
    Route::get('/dashboard/add-product', [ProductController::class, 'add'])->name('dashboard.addProduct');
    Route::post('/dashboard/add-product', [ProductController::class, 'store'])->name('dashboard.storeProduct');
    Route::get('/dashboard/my-products/user/{id}', [ProductController::class, 'listAllForSeller']);
    Route::get('/dashboard/my-products/user/delete-product/{id}', [ProductController::class, 'deleteProduct']);

});

//for user
Route::group(['middleware'=> ['auth', 'role:user']], function (){
    Route::get('/dashboard/profile', [UserController::class, 'myProfile'])->name('dashboard.profile');
});



//Route::get('/user/{id}', [UserController::class, 'show']);
require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
