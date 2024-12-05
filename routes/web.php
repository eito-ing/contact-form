<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Models\Contact;

//問い合わせ画面
Route::get('/contact', function () {
    return view('contact.form');
})->name('contact.form');

//問い合わせ完了通知画面
Route::get('/contact/perfect', function () {
    return view('contact.perfect'); // 問い合わせ完了通知画面を表示
})->name('contact.perfect');

// 問い合わせの送信処理
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');

// 管理者専用: 問い合わせ内容確認画面 (認証が必要)
Route::get('/admin/contact', function () {
    $contacts = Contact::all(); // 問い合わせ内容を全件取得
    return view('contact.index', compact('contacts'));
})->middleware('auth')->name('admin.contacts');

// ログイン画面
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // ログイン画面
Route::post('/login', [AuthController::class, 'login']); // ログイン処理

// ログアウト処理
Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // ログアウト

//ページネーション
Route::prefix('admin')->group(function () {
    Route::get('/contact', [ContactController::class, 'index'])->name('admin.contact.index');
});