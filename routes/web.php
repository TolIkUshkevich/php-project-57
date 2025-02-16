<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatusController;

Route::controller(PageController::class)->group(function () {
    Route::get('/', 'showMainPage')->name('main.page');
    Route::get('/task_statuses', 'showStatusesPage')->name('statuses.page');
    Route::get('/task_statuses/create', 'showStatusCreatePage')->name('status.create.page');
    Route::get('/task_statuses/{id}/edit', 'showStatusEditPage')->name('status.edit.page');
});

Route::controller(StatusController::class)->group(function () {
    Route::post('/task_statuses', 'create')->name('status.create');
    Route::patch('/task_statuses/{id}', 'update')->name('status.update');
    Route::delete('/task_statuses/{id}', 'destroy')->name('status.destroy');
});

require __DIR__.'/auth.php';
