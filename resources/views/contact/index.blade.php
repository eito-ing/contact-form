@extends('layouts.app')

@section('content')
<h2>問い合わせ内容一覧</h2>

@if ($contacts->isEmpty())
    <p class="text-center text-muted mt-4">現在、問い合わせ内容はありません。</p>
@else
    <table class="table table-bordered table-hover mt-4">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>氏名</th>
                <th>メールアドレス</th>
                <th>会社名</th>
                <th>問い合わせ内容</th>
                <th>送信日時</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->company ?? '会社名なし' }}</td>
                    <td>{{ $contact->message }}</td>
                    <td>{{ $contact->created_at->format('Y年m月d日 H時i分') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
