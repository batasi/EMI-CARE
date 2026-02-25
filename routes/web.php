<?php

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
Route::get('/contact', function () {
    return Inertia::render('contact/index');
});
require __DIR__.'/settings.php';
