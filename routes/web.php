<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatusController;

Route::get('/', [PageController::class, 'showMainPage'])->name('main');

Route::get('/login', [PageController::class, 'showLoginPage'])->name('loginPage');

Route::get('/register', [PageController::class, 'showRegPage'])->name('regPage');

Route::post('/register', [UserController::class, 'register'])->name('postReg');

Route::post('/login', [UserController::class, 'login'])->name('postLogin');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/task_statuses', [PageController::class, 'showStatusesPage'])->name('statusesPage');

Route::get('/task_statuses/create', [PageController::class, 'showStatusCreatePage'])->name('statusCreate');

Route::post('/task_statuses', [StatusController::class, 'create'])->name('postStatusCreate');