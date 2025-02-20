<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\likeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------|
| Web Routes                                                              |
|--------------------------------------------------------------------------|
| Here is where you can register web routes for your application. These   |
| routes are loaded by the RouteServiceProvider and all of them will       |
| be assigned to the "web" middleware group. Make something great!         |
|--------------------------------------------------------------------------|
*/
// lang route
Route::get('/lang-ar',function(){
    session()->put('lang','ar');
    return back();
   });
   Route::get('/lang-en',function(){
       session()->put('lang','en');
       return back();
   });

require __DIR__.'/auth.php';

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'lang'])->name('dashboard');

Route::middleware(['auth', 'lang'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Explore
Route::get('/explore', [PostController::class, 'explore'])->middleware('lang')->name('explore');

// User page
Route::get('/{user:username}', [UserController::class, 'index'])->middleware('lang')->name('user_profile');
Route::get('/{user:username}/edit', [UserController::class, 'edit'])->middleware(['auth', 'lang'])->name('edit_profile');
Route::patch('/{user:username}/update', [UserController::class, 'update'])->middleware(['auth', 'lang'])->name('update_profile');

// Post Routes
Route::controller(PostController::class)->middleware(['auth', 'lang'])->group(function() {
    Route::get('/', 'index')->name('home_page');
    
    // Create post
    Route::get('/p/create', 'create')->name('create_post');
    Route::post('/p/create', 'store')->name('store_post');
    
    // Show post
    Route::get('/p/{post:slug}', 'show')->name('show_post');

    // Edit post
    Route::get('/p/{post:slug}/edit', 'edit')->name('edit_post');
    Route::patch('/p/{post:slug}/update', 'update')->name('update_post');
    
    // Delete post
    Route::delete('/p/{post:slug}/delete', 'destroy')->name('delete_post');
});

// Like Route
Route::get('/p/{post:slug}/like', likeController::class)->middleware(['auth', 'lang']);

// Follow Routes
Route::get('/{user:username}/follow', [UserController::class, 'follow'])->middleware(['auth', 'lang'])->name('follow_user');
Route::get('/{user:username}/unfollow', [UserController::class, 'unfollow'])->middleware(['auth', 'lang'])->name('unfollow_user');

// Comment Route
Route::post('/p/{post:slug}/comment', [CommentController::class, 'store'])->middleware(['auth', 'lang'])->name('store_comment');

