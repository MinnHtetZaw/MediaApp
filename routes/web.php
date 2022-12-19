<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrendsPostController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    // admin
    Route:: get('dashboard',[ProfileController::class,'index'])->name('dashboard');
    Route:: post('admin/update',[ProfileController::class,'updateAdmin'])->name('admin#update');
    Route:: get('admin/Password',[ProfileController::class,'showPassword'])->name('admin#password');
    Route:: post('admin/changePassword',[ProfileController::class,'changePassword'])->name('admin#changePassword');

    // admin List
    Route:: get('adminList',[ListController::class,'index'])->name('admin#list');
    Route::get('adminList/delete/{id}',[ListController::class,'delete'])->name('admin#delete');
    Route::post('adminList',[ListController::class,'search'])->name('admin#search');

    // category
    Route:: get('category',[CategoryController::class,'index'])->name('admin#category');
    Route:: post('category/create',[CategoryController::class,'createCategory'])->name('admin#createCategory');
    Route:: get('category/delete/{id}',[CategoryController::class,'deleteCategory'])->name('admin#deleteCategory');
    Route::post('category/search',[CategoryController::class,'searchCategory'])->name('admin#categorySearch');
    Route:: get('category/edit/{id}',[CategoryController::class,'editCategory'])->name('admin#editCategory');
    Route::post('category/update/{id}',[CategoryController::class,'updateCategory'])->name('admin#updateCategory');
    //Posts
    Route:: get('post',[PostController::class,'index'])->name('admin#post');
    Route::post('post/createPost',[PostController::class,'createPost'])->name('admin#createPost');
    Route:: get('post/delete/{id}',[PostController::class,'deletePost'])->name('admin#deletePost');
    Route::get('post/update/{id}',[PostController::class,'updatePost'])->name('admin#updatePost');
    Route::post('post/updatePost/{id}',[PostController::class,'editPost'])->name('admin#editPOst');
    //Trend Posts
    Route:: get('trendPost',[TrendsPostController::class,'index'])->name('admin#trendPost');
});
