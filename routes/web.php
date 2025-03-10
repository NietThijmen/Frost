<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', 'organisation'])
    ->name('dashboard');

Route::middleware(['auth', 'organisation'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::middleware(['auth'])->prefix('/organisation')->group(function () {
    Route::get('/select', \App\Livewire\Organisation\Select::class)->name('organisation.select');
    Route::get('/create', \App\Livewire\Organisation\Create::class)->name('organisation.create');
});



require __DIR__.'/auth.php';
