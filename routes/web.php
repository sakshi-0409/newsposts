<?php

use App\Http\Controllers\newPostController;
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
})->name('home');


Route::get('/newpost', [newPostController::class, 'index'])->name('newpost');
Route::post('/create-post', [newPostController::class, 'store'])->name('create-post');
Route::get('/all-posts', [newPostController::class, 'show'])->name('all-posts');
Route::get('/deletepost/{id}', [newPostController::class, 'delete'])->name('delete-post');


Route::get('/dashboard', function () {
    return view('pages/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
