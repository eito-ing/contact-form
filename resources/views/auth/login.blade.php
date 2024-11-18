@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
    <div class="container mt-5">
        <h2>ログイン</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group mb-3">
                <label for="email">メールアドレス</label>
                <input type="email" class="form-control" id="email" name="email" >
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="password">パスワード</label>
                <input type="password" class="form-control" id="password" name="password" >
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">ログイン</button>
        </form>
    </div>
@endsection
