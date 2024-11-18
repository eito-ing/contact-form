<?php

use Illuminate\Support\Facades\Route;
//問い合わせ画面
Route::get('/contact', function () {
    return view('contact.form');
})->name('contact.form');

//問い合わせ完了通知画面
Route::get('/contact/perfect', function () {
    return view('contact.perfect'); // 問い合わせ完了通知画面を表示
})->name('contact.perfect');

// 問い合わせの送信処理
Route::post('/contact/submit', function (Illuminate\Http\Request $request) {
    // 問い合わせ完了通知画面にリダイレクト
    return redirect()->route('contact.perfect');
})->name('contact.submit');

use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // ログイン画面
Route::post('/login', [AuthController::class, 'login']); // ログイン処理
