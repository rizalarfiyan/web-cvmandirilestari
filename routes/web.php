<?php

use App\Http\Controllers\AuthController;
use App\Livewire\HomePage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');
Route::get('/login', [AuthController::class, 'login'])->name('login');
