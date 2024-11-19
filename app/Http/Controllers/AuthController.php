<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // ログインフォームの表示
    public function showLoginForm()
    {
        return view('auth.login'); // ログイン画面を表示
    }

    // ログイン処理
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required'], // メールアドレスまたは名前
            'password' => ['required'],
        ]);

        // メールアドレスまたは名前で認証を試行
        $loginField = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        if (Auth::attempt([$loginField => $credentials['login'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/contact'); // ログイン後のリダイレクト先
        }

        return back()->withErrors([
            'login' => '認証情報が正しくありません。',
        ]);
    }

    // ログアウト処理
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
