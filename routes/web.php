<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'deshboard', 'middleware'=>['auth']],function(){
    Route::resource('category',CategoryController::class);
    Route::resource('products',ProductController::class);
    Route::get('/changeStatuss',[ProductController::class,'changeStatuss'])->name('products.changeStatus');
    Route::post('/changeStatuss',[ProductController::class,'changeStatuss'])->name('products.changeStatus');
    Route::get('/categoryshare',[CategoryController::class,'categoryshare'])->name('categoryshare');    
});

Route::get('/clear-cache',function(){
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');

    return "cache is cleared";
   
});





