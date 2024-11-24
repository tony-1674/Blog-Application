<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BlogController::class, 'index'])->name('/');
Route::post('register', [BlogController::class, 'register'])->name('register');
Route::get('login', [BlogController::class, 'login'])->name('login');
Route::post('login-post', [BlogController::class, 'loginPost'])->name('login-post');
Route::get('admin-panel', [BlogController::class, 'adminPanel'])->name('admin-panel');


Route::middleware('auth')->group(function () {
    Route::get('home', [BlogController::class, 'home'])->name('home');
    Route::post('post-upload', [BlogController::class, 'postUpload'])->name('post-upload');
    Route::get('posts', [BlogController::class, 'posts'])->name('posts');
    Route::get('logout', [BlogController::class, 'logout'])->name('logout');
    
    Route::get('mobiles', [BlogController::class, 'mobiles'])->name('mobiles');
    Route::get('post-show', [BlogController::class, 'postShow'])->name('post-show');
    Route::get('electronics', [BlogController::class, 'electronics'])->name('electronics');
    Route::get('cars', [BlogController::class, 'cars'])->name('cars');

    Route::post('comment/{id}', [BlogController::class, 'comment'])->name('comment');
    Route::post('post-edit/{id}', [BlogController::class, 'postEdit'])->name('post-edit');
    Route::get('post-delete/{id}', [BlogController::class, 'postDelete'])->name('post-delete');
    
});
