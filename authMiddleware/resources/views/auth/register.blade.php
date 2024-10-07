@extends('masster')
@section('title')
    ĐĂng ký
@endsection
@section('content')
    <h1>Đăng kí tài khoản</h1>
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
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3 row">
                <label for="name" class="col-4 col-form-label">Name</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-4 col-form-label">Email</label>
                <div class="col-8">
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="password" class="col-4 col-form-label">Password</label>
                <div class="col-8">
                    <input type="password" class="form-control" name="password" id="password"
                        value="{{ old('password') }}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="password_confirmation" class="col-4 col-form-label">Confirm Password</label>
                <div class="col-8">
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
                        value="{{ old('password_confirmation') }}" />
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
    </div>
@endsection
