@extends('masster')

@section('content')
    <div class="container">
        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
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


        <form method="post" action="{{ route('startTransaction') }}">
            @csrf
            <div class="mb-3 row">
                <label for="amount" class="col-4 col-form-label">So tien</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="amount" id="amount" placeholder="amount"
                        value="{{ old('amount') }}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="receiver_account" class="col-4 col-form-label">Tai khoan giao dich</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="receiver_account" id="receiver_account"
                        placeholder="receiver_account" value="{{ old('receiver_account') }}" />
                </div>
            </div>

            <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-primary">
                        xác nhận
                    </button>
                </div>
            </div>
        </form>
    </div>
    <script>
        window.onbeforeunload = function() {
            @if (Session::has('transaction'))
                return "Bạn có phiên giao dịch chưa hoàn tất, bạn có muốn thoát?";
            @endif
        };
    </script>

@endsection
