<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademicianController;
use App\Http\Controllers\GrantController;
use App\Http\Controllers\MilestoneController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('academicians', AcademicianController::class);
Route::resource('grants', GrantController::class);
Route::resource('milestones', MilestoneController::class);
