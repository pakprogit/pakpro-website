<?php

use App\Http\Controllers\PublicHomeController;
use App\Http\Controllers\UserInvitationController;
use Illuminate\Support\Facades\Route;

// Public Website Routes
Route::get('/', [PublicHomeController::class, 'index'])->name('home');
Route::post('/contact', [PublicHomeController::class, 'submitContact'])->name('contact.submit');

// User Invitation Routes (signed link expiring in 48 hours)
Route::get('/invitation/{token}', [UserInvitationController::class, 'show'])->name('invitation.accept');
Route::post('/invitation/{token}', [UserInvitationController::class, 'process'])->name('invitation.process');
