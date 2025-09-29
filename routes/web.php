<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Chat\Index;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//chat routes
Route::get('/chat', function() {
    return view('chat.index');
})->name('chat.index');

Route::get('/chat/{query}', function() {
    return view('chat.chat');
})->name('chat.chat');

Route::get('/users-list', function() {
    $users = \App\Models\User::all();
    return view('chat.users', compact('users'));
})->name('chat.users');

require __DIR__.'/auth.php';
