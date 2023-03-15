<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::prefix('books')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('books.index');
    Route::get('/create', [BookController::class, 'create'])->name('books.create');
    Route::get('/{id}', [BookController::class, 'show'])->name('books.show');
    Route::post('/', [BookController::class, 'store'])->name('books.store');
    Route::get('/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/{id}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/{id}', [BookController::class, 'destroy'])->name('books.destroy');
});

Route::resource('categories', CategoryController::class);
