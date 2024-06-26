<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactListController;
use App\Http\Controllers\ProfileController;
use App\Http\controllers\Hash;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user(); // Get the authenticated user
        return view('dashboard', ['user' => $user]); // Pass the user to the view
    })->name('dashboard.home');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Routes for showing modals
    Route::get('/dashboard/contacts', [ContactListController::class, 'index'])->name('contacts.index');
    Route::post('/dashboard/contacts', [ContactListController::class, 'store'])->name('contacts.store');
    Route::get('/dashboard/contacts/{contactList}', [ContactListController::class, 'edit'])->name('contacts.edit');
    Route::put('/dashboard/contacts/{contactList}', [ContactListController::class, 'update'])->name('contacts.update');
    Route::delete('/dashboard/contacts/{contactList}', [ContactListController::class, 'destroy'])->name('contacts.destroy');

    Route::get('/dashboard/profile', [ProfileController::class, 'show'])->name('profile.show');

    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

    
});
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');


