<?php

use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'index'])->name('home');

Route::prefix('blog')->name('blog.')->group(function (): void {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
    Route::post('/{slug}/comments', [BlogController::class, 'comment'])->name('comment');
});

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::redirect('/login', '/admin/login')->name('login');

Route::get('/admin/login', [AdminLoginController::class, 'create'])->middleware('guest')->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'store'])->middleware('guest')->name('admin.login.store');
Route::post('/admin/logout', [AdminLoginController::class, 'destroy'])->middleware('auth')->name('admin.logout');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function (): void {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::resource('projects', ProjectController::class)->except(['show']);
    Route::resource('skills', SkillController::class)->except(['show']);
    Route::resource('testimonials', TestimonialController::class)->except(['show']);
    Route::resource('blog-categories', BlogCategoryController::class)->except(['show']);
    Route::resource('blog-posts', BlogPostController::class)->except(['show']);

    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

    Route::get('/settings', [SiteSettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SiteSettingController::class, 'update'])->name('settings.update');
});
