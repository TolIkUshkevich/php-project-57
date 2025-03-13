<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LabelController;

Route::controller(PageController::class)->group(function () {
    Route::get('/', 'showMainPage')->name('main.page');
    Route::get('/task_statuses', 'showStatusesPage')->name('statuses.page');
    Route::get('/task_statuses/create', 'showStatusCreatePage')->name('status.create.page');
    Route::get('/task_statuses/{status}/edit', 'showStatusUpdatePage')->name('status.update.page');
    Route::get('/tasks', 'showTasksPage')->name('tasks.page');
    Route::get('/tasks/create', 'showTaskCreatePage')->name('task.create.page');
    Route::get('/tasks/{task}/edit', 'showTaskUpdatePage')->name('task.update.page');
    Route::get('/tasks/{task}', 'showTaskPage')->name('task.page');
    Route::get('/labels', 'showLabelsPage')->name('labels.page');
    Route::get('/labels/create', 'showLabelsCreatePage')->name('labels.create.page');
    Route::get('/labels/{label}/edit', 'showLabelUpdatePage')->name('label.update.page');
});

Route::controller(StatusController::class)->group(function () {
    Route::post('/task_statuses', 'create')->name('status.create');
    Route::patch('/task_statuses/{status}', 'update')->name('status.update');
    Route::delete('/task_statuses/{status}', 'destroy')->name('status.destroy');
});

Route::controller(TaskController::class)->group(function () {
    Route::post('/tasks', 'create')->name('task.create');
    Route::patch('/tasks/{task}', 'update')->name('task.update');
    Route::delete('/tasks/{task}', 'destroy')->name('task.destroy');
});

Route::controller(LabelController::class)->group(function () {
    Route::post('/labels/create', 'create')->name('label.create');
    Route::patch('/labels/{label}', 'update')->name('label.update');
    Route::delete('/labels/{label}', 'destroy')->name('label.destroy');
});

require __DIR__.'/auth.php';
