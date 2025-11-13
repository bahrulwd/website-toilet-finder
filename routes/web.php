<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ToiletController;
use App\Http\Controllers\ToiletReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserReviewController;
use App\Http\Controllers\ReportController;

Route::get('/', [LandingController::class, 'index'])->name('landing');
// atau
Route::get('/', [LandingController::class, 'index'])->name('app');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/app', function () {
    return view('app');
});

Route::get('/signin', function () {
    return view('signin');
})->name('signin');

Route::get('/signup', function () {
    return view('login'); // atau 'signup' jika file Anda sudah diganti namanya
})->name('signup');

Route::get('/submit', function () {
    return view('submit');
})->name('submit');

Route::post('/submit', [ToiletController::class, 'store'])->name('toilet.store');
Route::get('/toilets/{id}/reviews', [ToiletReviewController::class, 'show'])->name('toilet.review.show');
Route::post('/toilets/{id}/reviews', [ToiletReviewController::class, 'store'])->name('toilet.review.store');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/about', [\App\Http\Controllers\AboutController::class, 'index'])->name('about');
Route::get('/reviews', function () {
    return view('review');
})->name('review.index');
Route::get('/user-reviews', [UserReviewController::class, 'index'])->name('user.reviews');
Route::post('/user-reviews', [UserReviewController::class, 'store'])->name('user.review.store');
Route::get('/findtoilet', [LandingController::class, 'findToilet'])->name('findtoilet');
Route::get('/findtoilet/all', [LandingController::class, 'findToiletAll'])->name('findtoilet.all');

Route::get('/report', [ReportController::class, 'index'])->name('report');
Route::get('/report/{id}', [ReportController::class, 'show'])->name('report.show');