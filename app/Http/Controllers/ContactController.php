<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // サーバーサイドのバリデーション
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'company' => 'nullable|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // データベースに保存
        Contact::create($validated);

        // 問い合わせ完了画面にリダイレクト
        return redirect()->route('contact.perfect')->with('status', 'お問い合わせが送信されました！');
    }
    public function index()
    {
        // ページネーションを設定 (1ページに表示する件数を10件に設定)
        $contacts = Contact::paginate(10);

        // ビューにデータを渡す
        return view('contact.index', compact('contacts'));
    }
}