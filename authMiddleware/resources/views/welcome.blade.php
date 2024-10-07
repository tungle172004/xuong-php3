@extends('masster')
@section('title')
    WELCOME
@endsection
@section('content')
    <h1>WELCOME To My website</h1>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
@endsection
