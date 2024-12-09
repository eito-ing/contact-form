<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\User; // Userモデルをインポート
use App\Mail\InquiryNotification;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function showContactForm()
    {
        // 問い合わせフォームを表示
        return view('contact.form');
    }

    public function showContactPerfect()
    {
        // 問い合わせ完了画面を表示
        return view('contact.perfect');
    }

    public function submit(ContactRequest $request)
    {
        // バリデーション済みデータを取得
        $validated = $request->validated();

        // データベースに保存
        $contact = Contact::create($validated);

        $adminEmails = User::pluck('email')->toArray();

        // 無効なメールアドレスを除外するためのフィルタリング
        $validEmails = array_filter($adminEmails, function ($email) {
            return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
        });

        foreach ($validEmails as $email) {
            try {
                Mail::to($email)->send(new InquiryNotification($contact));
                \Log::info('メールが正常に送信されました: ' . $email);
            } catch (\Exception $e) {
                \Log::error('メール送信に失敗しました: ' . $e->getMessage() . '（送信先: ' . $email . '）');
            }
        }

        // 問い合わせ完了画面にリダイレクト
        return redirect()->route('contact.perfect')->with('status', 'お問い合わせが送信されました！');
    }

    public function index(Request $request)
    {
        // ページネーションを設定 (1ページに表示する件数を10件に設定)
        $contacts = Contact::paginate(10);

        // ビューにデータを渡す
        return view('contact.index', compact('contacts'));
    }
}

