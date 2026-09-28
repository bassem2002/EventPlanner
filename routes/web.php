<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BwCategoryController;
use App\Http\Controllers\Admin\BwEventController;   
use App\Http\Controllers\EventBwController;
use App\Http\Controllers\Users\BwRegisterController;
use App\Http\Controllers\Users\BwRegistrationController;
use App\Http\Controllers\Users\BwCategoryViewController;
use App\Http\Controllers\Users\BwEventViewController;
use App\Http\Controllers\Users\MyEventsBw;
use App\Http\Controllers\Admin\AdminUserRegistrationBw;
use App\Http\Controllers\Admin\BwUserController;
use App\Http\Controllers\AuthController;

// 🏠 Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/accueil', function () {
    return view('user.home');
})->name('user.home');

// 🔐 Auth Routes
Route::get('login', [AuthController::class, "login"])->name("login");
Route::post('toLogin', [AuthController::class, "toLogin"])->name("toLogin");
Route::post('/logout', [AuthController::class, "logout"])->name("logout");

// 📝 Registration Routes (Guest Only)
Route::get('/register', [BwRegisterController::class, 'create'])->name('user.register');
Route::post('/register', [BwRegisterController::class, 'store'])->name('user.store');

// 👥 USER ROUTES - Protected by auth + user role middleware
Route::middleware(['auth', 'user'])->prefix('user')->group(function () {
    // 📂 Categories Routes (Read-only)
    Route::prefix('categories')->group(function () {
        Route::get('/', [BwCategoryViewController::class, 'index'])->name('user.categories.index');
        Route::get('/{id}', [BwCategoryViewController::class, 'show'])->name('user.categories.show');
    });

    // 📅 Events Routes (Read-only + Registration)
    Route::prefix('events')->group(function () {
        Route::get('/', [BwEventViewController::class, 'index'])->name('user.events.index');
        Route::get('/{id}', [BwEventViewController::class, 'show'])->name('user.events.show');
        Route::post('/{id}/register', [BwEventViewController::class, 'register'])->name('user.events.register');
    });

    // 📅 My Events Route
    Route::get('/my-events', [MyEventsBw::class, 'index'])->name('user.my-events');

    // 🗑️ Registration Routes
    Route::delete('/registrations/{id}', [BwRegistrationController::class, 'destroy'])->name('user.registrations.destroy');
});

// 🔐 ADMIN ROUTES - Protected by auth + admin role middleware
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // 📂 Categories CRUD Routes
    Route::prefix('categories')->group(function () {
        Route::get('/', [BwCategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/create', [BwCategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/', [BwCategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/{id}/edit', [BwCategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('/{id}', [BwCategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/{id}', [BwCategoryController::class, 'destroy'])->name('admin.categories.destroy');
    });

    // 📅 Events CRUD Routes
    Route::prefix('events')->group(function () {
        Route::get('/', [BwEventController::class, 'index'])->name('admin.events.index');
        Route::get('/create', [BwEventController::class, 'create'])->name('admin.events.create');
        Route::post('/', [BwEventController::class, 'store'])->name('admin.events.store');
        Route::get('/{id}/edit', [BwEventController::class, 'edit'])->name('admin.events.edit');
        Route::put('/{id}', [BwEventController::class, 'update'])->name('admin.events.update');
        Route::delete('/{id}', [BwEventController::class, 'destroy'])->name('admin.events.destroy');
    });

    // 👥 Users & Registrations Routes
    Route::prefix('users')->group(function () {
        Route::get('/', [BwUserController::class, 'index'])->name('admin.users.index');
        Route::get('/create', [BwUserController::class, 'create'])->name('admin.users.create');
        Route::post('/', [BwUserController::class, 'store'])->name('admin.users.store');
        Route::get('/registrations', [AdminUserRegistrationBw::class, 'index'])->name('admin.users.registrations.index');
        Route::get('/{id}', [BwUserController::class, 'show'])->name('admin.users.show');
        Route::get('/{id}/edit', [BwUserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/{id}', [BwUserController::class, 'update'])->name('admin.users.update');
        Route::delete('/{id}', [BwUserController::class, 'destroy'])->name('admin.users.destroy');
    });
});
