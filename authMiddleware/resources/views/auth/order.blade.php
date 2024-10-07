@extends('masster')
@section('title')
    Quản lý order
@endsection
@section('content')
        <h1>Quản lý order</h1>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
@endsection