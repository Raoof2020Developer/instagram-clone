<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
require __DIR__.'/auth.php';

// Route::get('/', function () {
    //     return view('welcome');
// });
Route::get('/explore', [PostController::class, 'explore'])->name('explore')->middleware('auth');
Route::get('/{user:username}', [UserController::class, 'index'])->middleware('auth')->name('user_profile');
Route::get('/{user:username}/edit', [UserController::class, 'edit'])->middleware('auth')->name('user_profile.edit');
Route::patch('/{user:username}/update', [UserController::class, 'update'])->middleware('auth')->name('user_profile.update');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [PostController::class, 'index'])->name('home_page');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/{post:slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::patch('/posts/{post:slug}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post:slug}', [PostController::class, 'delete'])->name('posts.destroy');


Route::post('/posts/{post:slug}/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');
Route::get('/posts/{post:slug}/like', LikeController::class)->name('posts.likes')->middleware('auth');
Route::get('/{user:username}/follow', [UserController::class, 'follow'])->name('users.follow')->middleware('auth');
Route::get('/{user:username}/unfollow', [UserController::class, 'unfollow'])->name('users.unfollow')->middleware('auth');