<?php

use App\Http\Controllers\ToDoController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');


    Route::get('/todos', [ToDoController::class, 'index'])->name('todos');

    Route::post('/todos', [ToDoController::class, 'store'])->name('todos.store');

    Route::post('/todos/update/{id}', [ToDoController::class, 'update'])->name('todos.update');

    Route::delete('/todos/{id}', [ToDoController::class, 'delete'])->name('todos.delete');

});
