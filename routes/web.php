<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LabelController;

Route::get('/', function() {
    return view('showMainPage');
})->name('main.page');

Route::controller(StatusController::class)->group(function () {
    Route::get('/task_statuses', 'index')->name('statuses.page');
    Route::get('/task_statuses/create', 'create')->name('status.create.page');
    Route::get('/task_statuses/{status}/edit', 'edit')->name('status.update.page');
    Route::post('/task_statuses', 'store')->name('status.create');
    Route::patch('/task_statuses/{status}', 'update')->name('status.update');
    Route::delete('/task_statuses/{status}', 'destroy')->name('status.destroy');
});

Route::controller(TaskController::class)->group(function () {
    Route::get('/tasks', 'index')->name('tasks.page');
    Route::get('/tasks/create', 'create')->name('task.create.page');
    Route::get('/tasks/{task}/edit', 'edit')->name('task.update.page');
    Route::get('/tasks/{task}', 'show')->name('task.page');
    Route::post('/tasks', 'store')->name('task.create');
    Route::patch('/tasks/{task}', 'update')->name('task.update');
    Route::delete('/tasks/{task}', 'destroy')->name('task.destroy');
});

Route::controller(LabelController::class)->group(function () {
    Route::get('/labels', 'index')->name('labels.page');
    Route::get('/labels/create', 'create')->name('labels.create.page');
    Route::get('/labels/{label}/edit', 'edit')->name('label.update.page');
    Route::post('/labels', 'store')->name('label.create');
    Route::patch('/labels/{label}', 'update')->name('label.update');
    Route::delete('/labels/{label}', 'destroy')->name('label.destroy');
});

require __DIR__ . '/auth.php';
