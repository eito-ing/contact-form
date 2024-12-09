<?php
use Illuminate\Support\Facades\Route;

// 問い合わせ画面
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'showContactForm'])->name('contact.form');

// 問い合わせ完了通知画面
Route::get('/contact/perfect', [App\Http\Controllers\ContactController::class, 'showContactPerfect'])->name('contact.perfect');

// 問い合わせの送信処理
Route::post('/contact/submit', [App\Http\Controllers\ContactController::class, 'submit'])->name('contact.submit');

// ログイン画面
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

// ログアウト処理
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// 管理者画面（認証が必要）
Route::middleware('auth')->prefix('admin')->group(function () {
    // 問い合わせ内容確認・ページネーション
    Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
});

Route::get('/export-inquiries', [App\Http\Controllers\InquiryExportController::class, 'export'])->name('contacts.export');
