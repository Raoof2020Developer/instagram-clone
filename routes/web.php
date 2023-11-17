<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show')->middleware('auth');
Route::get('/posts/{post:slug}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');
Route::patch('/posts/{post:slug}', [PostController::class, 'update'])->name('posts.update')->middleware('auth');


Route::post('/posts/{post:slug}/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');

Route::middleware('auth')->group(function() {
    
    Route::resource('posts', PostController::class);


    Route::post('/posts/{post:slug}/comments', [CommentController::class, 'store'])->name('comments.store');
});

require __DIR__.'/auth.php';
