<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/about', function () {
    return Inertia::render('about/story');
});
Route::get('/impact', function () {
    return Inertia::render('impact/index');
});
Route::get('/donations', function () {
    return Inertia::render('donations/index');
});
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Admin routes (protected by middleware)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/contact-submissions', [ContactController::class, 'adminIndex'])->name('contact-submissions.index');
    Route::get('/contact-submissions/{submission}', [ContactController::class, 'adminShow'])->name('contact-submissions.show');
    Route::put('/contact-submissions/{submission}', [ContactController::class, 'adminUpdate'])->name('contact-submissions.update');
    Route::delete('/contact-submissions/{submission}', [ContactController::class, 'adminDestroy'])->name('contact-submissions.destroy');
    Route::get('/contact-submissions/export/csv', [ContactController::class, 'adminExport'])->name('contact-submissions.export');
});
require __DIR__.'/settings.php';
