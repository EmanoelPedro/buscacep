<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;

Route::get('/',[SiteController::class, 'home'])->name('site.home');
Route::get('/pesquisa', [SiteController::class, 'search'])->name('site.search');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/address', [AddressController::class,'store'])->name('address.create');
    Route::delete('/address/{id}', [AddressController::class,'destroy'])->name('address.destroy');
    Route::get('/meus-enderecos', [AddressController::class,'index'])->name('addresses.list');
});

require __DIR__.'/auth.php';
