@extends('masster')
@section('title')
    ĐĂng Nhập
@endsection
@section('content')
    <h1>Đăng Nhập tài khoản</h1>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3 row">
                <label for="email" class="col-4 col-form-label">email</label>
                <div class="col-8">
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="password" class="col-4 col-form-label">password</label>
                <div class="col-8">
                    <input type="password" class="form-control" name="password" id="password"
                        value="{{ old('password') }}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="remember" class="col-4 col-form-label">remember</label>
                <div class="col-8">
                    <input type="checkbox" class="form-checkbox" name="remember" id="remember"
                        value="{{ old('remember') }}" />
                </div>
            </div>
            <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-primary">
                        register
                    </button>
                </div>
            </div>
        </form>

        <a href="{{ route('password.request') }}">Quên mật khẩu</a>
    </div>
@endsection
