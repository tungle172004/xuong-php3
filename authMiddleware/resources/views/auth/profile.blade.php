@extends('masster')
@section('title')
    profile
@endsection
@section('content')
    <h1>Profile</h1>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
@endsection
