<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TaskController;

Route::controller(PageController::class)->group(function () {
    Route::get('/', 'showMainPage')->name('main.page');
    Route::get('/task_statuses', 'showStatusesPage')->name('statuses.page');
    Route::get('/task_statuses/create', 'showStatusCreatePage')->name('status.create.page');
    Route::get('/task_statuses/{id}/edit', 'showStatusEditPage')->name('status.update.page');
    Route::get('/tasks', 'showTasksPage')->name('tasks.page');
    Route::get('/tasks/create', 'showTaskCreatePage')->name('task.create.page');
    Route::get('/tasks/{id}/update', 'showTaskUpdatePage')->name('task.update.page');
    Route::get('/tasks/{id}', 'showTaskPage')->name('task.page');
});

Route::controller(StatusController::class)->group(function () {
    Route::post('/task_statuses', 'create')->name('status.create');
    Route::patch('/task_statuses/{id}', 'update')->name('status.update');
    Route::delete('/task_statuses/{id}', 'destroy')->name('status.destroy');
});

Route::controller(TaskController::class)->group(function () {
    Route::post('/tasks', 'create')->name('task.create');
    Route::patch('/tasks/{id}', 'update')->name('task.update');
    Route::delete('/tasks/{id}', 'destroy')->name('task.destroy');
});

require __DIR__.'/auth.php';
