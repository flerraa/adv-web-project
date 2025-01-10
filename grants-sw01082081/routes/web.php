<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademicianController;
use App\Http\Controllers\GrantController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\DashboardController;

// Make dashboard the landing page instead of welcome
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Resource routes
Route::resource('academicians', AcademicianController::class);
Route::resource('grants', GrantController::class);
Route::resource('milestones', MilestoneController::class);

// Additional routes for grant members
Route::post('grants/{grant}/add-member', [GrantController::class, 'addMember'])
    ->name('grants.add-member');
Route::delete('grants/{grant}/remove-member', [GrantController::class, 'removeMember'])
    ->name('grants.remove-member');

// Additional routes for milestone status
Route::patch('milestones/{milestone}/update-status', [MilestoneController::class, 'updateStatus'])
    ->name('milestones.update-status');