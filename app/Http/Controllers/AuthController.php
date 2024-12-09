<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\RegisterRequest;

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

    // サインアップフォームの表示
    public function showRegisterForm()
    {
        return view('auth.register'); // サインアップ画面を表示
    }

    // サインアップ処理
    public function register(RegisterRequest $request)
    {
        // バリデーション済みデータを取得
        $validated = $request->validated();

        // ユーザーの作成とログイン処理
        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = bcrypt($validated['password']);
        $user->save();

        Auth::login($user);

        return redirect()->route('admin.contact.index');
    }
}
