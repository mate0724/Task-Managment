<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;

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

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');



Route::get('/', function () {
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
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('tasks/create', [TaskController::class, 'create'])->name('groups.tasks.create');
    Route::post('tasks', [TaskController::class, 'store'])->name('groups.tasks.store');
    Route::get('tasks/{task}/edit', [TaskController::class, 'edit'])->name('groups.tasks.edit');
    Route::put('tasks/{task}', [TaskController::class, 'update'])->name('groups.tasks.update');
    Route::get('tasks/{task}', [TaskController::class, 'show'])->name('groups.tasks.show');
    Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->name('groups.tasks.destroy');
});

Route::get('tasks', [TaskController::class, 'index'])->name('groups.tasks.index');



Route::prefix('tasks/{task}')->group(function () {
    //Route::post('comments', [CommentController::class, 'store'])->name('tasks.comments.store');
    Route::post('comments', [CommentController::class, 'store'])->name('tasks.comments.store');

    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('tasks.comments.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/meetings', [MeetingController::class, 'index'])->name('meetings.index');
    Route::get('/meetings/create', [MeetingController::class, 'create'])->name('meetings.create');
    Route::post('/meetings', [MeetingController::class, 'store'])->name('meetings.store');
});

Route::get('locale/{lang}', [LocaleController::class, 'setLocale']);

Route::get('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

require __DIR__ . '/auth.php';
