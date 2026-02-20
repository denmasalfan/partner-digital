<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MessageController;

// --- HALAMAN UTAMA ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');

// --- HALAMAN KONTAK (Gunakan MessageController agar Sinkron) ---
// Menampilkan Form
Route::get('/contact', [MessageController::class, 'index'])->name('contact');

// Memproses Kiriman Pesan
Route::post('/contact', [MessageController::class, 'send'])->name('contact.send');