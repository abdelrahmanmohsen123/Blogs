<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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
Route::group(['prefix' => 'Dashboard'], function() {

    Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name("post.all");
    Route::get('/post/create', [App\Http\Controllers\PostController::class, 'create'])->name("post.create");
    Route::post('/post/store', [App\Http\Controllers\PostController::class, 'store'])->name("post.store");

    Route::get('/post/{id}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name("post.edit");
    Route::put('/post/{id}/update', [App\Http\Controllers\PostController::class, 'update'])->name("post.update");
    Route::delete('/post/{id}/delete', [App\Http\Controllers\PostController::class, 'destroy'])->name("post.delete");




    /// comments
    Route::get('/comments', [CommentController::class, 'index'])->name("comment.all");
    Route::get('/comment/create', [CommentController::class, 'create'])->name("comment.create");
    Route::post('/comment/store', [App\Http\Controllers\CommentController::class, 'store'])->name("comment.store");
    Route::get('/comment/{id}/edit', [App\Http\Controllers\CommentController::class, 'edit'])->name("comment.edit");
    Route::put('/comment/{id}/update', [App\Http\Controllers\CommentController::class, 'update'])->name("comment.update");
    Route::delete('/comment/{id}/delete', [App\Http\Controllers\CommentController::class, 'destroy'])->name("comment.delete");

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/{any}', function ($any) {

    return view('404');
  
  })->where('any', '.*');