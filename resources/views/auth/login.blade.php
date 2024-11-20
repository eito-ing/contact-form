@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
<div class="mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>ログイン</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="login">メールアドレス または ユーザー名</label>
                    <input type="text" class="form-control" id="login" name="login">
                    @error('login')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="password">パスワード</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">ログイン</button>
            </form>
        </div>
    </div>
</div>
</div>
@endsection