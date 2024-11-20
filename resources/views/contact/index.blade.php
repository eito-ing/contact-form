@extends('layouts.app')

@section('indexapp-css')
<link rel="stylesheet" href="{{ asset('css/indexapp.css') }}">
@endsection

@section('content')
<div class="container mt-4">
    <h2 class="text-center fw-bold">問い合わせ内容一覧</h2>
</div>

@if ($contacts->isEmpty())
    <div class="container mt-5">
        <p class="text-center text-muted">現在、問い合わせ内容はありません。</p>
    </div>
@else

    <!-- PC向けテーブル -->
    <div class="container mt-5 d-none d-md-block">
        <table class="table table-bordered table-hover table-striped align-middle" style="background-color: #f8f9fa;">
            <thead style="background-color: #007bff; color: white;">
                <tr class="text-center">
                    <th style="width: 5%;">ID</th>
                    <th style="width: 10%;">氏名</th>
                    <th style="width: 15%;">メールアドレス</th>
                    <th style="width: 20%;">会社名</th>
                    <th style="width: 30%;">問い合わせ内容</th>
                    <th style="width: 20%;">送信日時</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td class="text-center">{{ $contact->id }}</td>
                        <td>{{ $contact->name }}</td>
                        <td class="word-wrap">{{ $contact->email }}</td>
                        <td>{{ $contact->company ?? '会社名なし' }}</td>
                        <td>
                            <span title="{{ $contact->message }}">
                                {{ Str::limit($contact->message, 50, '...') }}
                            </span>
                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modal{{ $contact->id }}">
                                詳細
                            </button>
                        </td>
                        <td class="text-center">{{ $contact->created_at->format('Y年m月d日 H時i分') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <!-- スマホ向けテーブル -->
    <div class="container mt-5 d-md-none">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>氏名</th>
                        <th>メールアドレス</th>
                        <th>会社名</th>
                        <th>問い合わせ内容</th>
                        <th>日時</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>{{ $contact->name }}</td>
                            <td class="word-wrap">{{ $contact->email }}</td>
                            <td>{{ $contact->company ?? '会社名なし' }}</td>
                            <td>{{ Str::limit($contact->message, 30, '...') }}
                                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modal{{ $contact->id }}">
                                    詳細
                                </button>
                            </td>
                            <td>{{ $contact->created_at->format('Y年m月d日') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!-- モーダル -->
    @foreach ($contacts as $contact)
        <div class="modal fade" id="modal{{ $contact->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $contact->id }}"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel{{ $contact->id }}">問い合わせ内容の詳細</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>名前:</strong> {{ $contact->name }}</p>
                        <p><strong>メールアドレス:</strong> {{ $contact->email }}</p>
                        <p><strong>会社名:</strong> {{ $contact->company ?? '会社名なし' }}</p>
                        <p><strong>問い合わせ内容:</strong></p>
                        <p>{{ $contact->message }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endif
@endsection