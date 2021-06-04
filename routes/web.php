<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function (){
    Route::get('/', [OrderController::class, 'index'])->name('home');
    Route::get('/users',[UserController::class,'index'])->name('users');
    Route::get('/categories',[CategoryController::class,'index'])->name('categoriesList');
    Route::get('/categories/{category}',[CategoryController::class,'edit'])->name('categoriesEdit');
    Route::delete('/categories/{category}',[CategoryController::class,'destroy'])->name('categoriesDestroy');
    Route::get('/products',[ProductController::class,'index'])->name('productsList');
    Route::get('/products/create',[ProductController::class,'create'])->name('productsCreate');
    Route::get('/products/edit/{product}',[ProductController::class,'edit'])->name('productsEdit'); #za get prikazuje se productsedit 
    Route::post('/products/create',[ProductController::class,'store'])->name('productsStore'); #za post prikazuje se productsStore fja 
    Route::put('/products/edit/{product}',[ProductController::class,'update'])->name('productsUpdate');
    Route::delete('/products/destroy/{product}',[ProductController::class,'destroy'])->name('productsDestroy');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
