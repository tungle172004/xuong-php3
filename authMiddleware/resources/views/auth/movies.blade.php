@extends('masster')
@section('title')
    movies
@endsection
@section('content')
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<h1>Movies</h1>
@endsection