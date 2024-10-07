@extends('masster')
@section('title')
    Admin
@endsection
@section('content')

        <h1>quản lý website</h1>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
@endsection