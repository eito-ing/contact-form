<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function submit(ContactRequest $request)
    {
        // バリデーション済みデータを取得
        $validated = $request->validated();

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