<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

// Remove or comment out the welcome route
// Route::get('/', function () {
//     return view('welcome');
// });

// Make root route go to blog
Route::get('/', [BlogController::class, 'index']);

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');