<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\TextController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public landing page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Contact form submission
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Text converter tool
Route::prefix('tools')->name('tools.')->group(function () {
    Route::get('/convert-text', [TextController::class, 'index'])->name('convert-text.index');
    Route::post('/convert-text', [TextController::class, 'convert'])->name('convert-text.convert');
});

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin routes
    Route::prefix('admin')->name('admin.')->group(function () {
        // Profile
        Route::resource('profiles', AdminProfileController::class);

        // Skills
        Route::resource('skills', SkillController::class);

        // Galleries
        Route::resource('galleries', GalleryController::class);

        // Projects
        Route::resource('projects', ProjectController::class);

        // Contact Messages
        Route::get('messages', [ContactMessageController::class, 'index'])->name('messages.index');
        Route::get('messages/{contactMessage}', [ContactMessageController::class, 'show'])->name('messages.show');
        Route::delete('messages/{contactMessage}', [ContactMessageController::class, 'destroy'])->name('messages.destroy');

        // Account Settings
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('settings/information', [SettingController::class, 'updateInformation'])->name('settings.update-information');
        Route::put('settings/password', [SettingController::class, 'updatePassword'])->name('settings.update-password');
    });
});

// Breeze profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
