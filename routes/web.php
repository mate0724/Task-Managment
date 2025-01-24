<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;

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


Route::get('/', function(){
    return redirect('/login');
});

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/users/export', [UserController::class, 'export'])->name('users.export');

Route::middleware(['auth'])->group(function () {
    Route::resource('groups', GroupController::class);
});


Route::prefix('groups/{group}')->group(function () {
    Route::get('tasks', [TaskController::class, 'index'])->name('groups.tasks.index');
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('tasks/create', [TaskController::class, 'create'])->name('groups.tasks.create');
    Route::post('tasks', [TaskController::class, 'store'])->name('groups.tasks.store');
    Route::get('tasks/{task}/edit', [TaskController::class, 'edit'])->name('groups.tasks.edit');
    Route::put('tasks/{task}', [TaskController::class, 'update'])->name('groups.tasks.update');
    Route::get('tasks/{task}', [TaskController::class, 'show'])->name('groups.tasks.show');
    Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->name('groups.tasks.destroy');
});

// Kommentek kezelése
Route::prefix('tasks/{task}')->group(function () {
    //Route::post('comments', [CommentController::class, 'store'])->name('tasks.comments.store');
    Route::post('comments', [CommentController::class, 'store'])->name('tasks.comments.store');

    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('tasks.comments.destroy');
});

require __DIR__.'/auth.php';
