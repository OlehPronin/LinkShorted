<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

// Главная страница
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Страница панели управления (требует авторизации и подтверждения)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Маршруты для профиля (только для авторизованных пользователей)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile'); // Профиль пользователя
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Маршруты для авторизации и регистрации
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Отображение страницы сокращения ссылок (GET)
Route::get('/shorten', [LinkController::class, 'create'])->name('link.shorten');

// Обработка отправки формы сокращения ссылок (POST)
Route::post('/shorten', [LinkController::class, 'store'])->name('link.store');

// Страница контактов
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Отправка формы контакта (POST)
Route::post('/contact/send', [ContactController::class, 'send'])->middleware('auth')->name('contact.send');

// Маршрут по сокращенной ссылке (перенаправление на оригинальный URL)
Route::get('/{shortened_url}', [LinkController::class, 'redirect'])->name('link.redirect');

// Удаление ссылки (только для авторизованных пользователей)
Route::delete('/link/{id}', [LinkController::class, 'destroy'])->middleware('auth')->name('link.destroy');

// Изменение пароля
Route::put('/user/password', [ChangePasswordController::class, 'update'])->name('password.update');
