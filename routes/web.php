<?php

use App\Http\Controllers\AuthController\LoginController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'loginView']);
Route::post('login', [LoginController::class, 'login'])->name('login');

Route::group(['middleware' => 'verification'], fn() => [
    Route::get('index', [HomeController::class, 'index'])->name('index'),
    Route::get('profile/{user_id}', [HomeController::class, 'profile'])->name('profile'),
    Route::get('logout', [AuthorController::class, 'logout'])->name('logout'),
    Route::group(['prefix' => 'author'], fn() => [
        Route::get('/', [AuthorController::class, 'index'])->name('author.index'),
        Route::get('show/{author_id}', [AuthorController::class, 'show'])->name('author.show'),
        Route::get('delete/{author_id}', [AuthorController::class, 'delete'])->name('author.delete'),
    ]),

    Route::group(['prefix' => 'book'], fn() => [
        Route::get('create', [BookController::class, 'create'])->name('book.create'),
        Route::post('store', [BookController::class, 'store'])->name('book.store'),
        Route::get('/{book_id}', [BookController::class, 'delete'])->name('book.delete'),
        Route::get('show/{book_id}', [BookController::class, 'show'])->name('book.show'),
    ]),
]);
