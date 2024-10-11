@extends('masster')

@section('content')
    <h1>Confirm</h1>
    <div>
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

        <h2>Xác nhận giao dịch</h2>
        <p>Số tiền: {{ $transaction['amount'] }}</p>
        <p>Tài khoản nhận tiền: {{ $transaction['receiver_account'] }}</p>

        <form action="{{ route('complete') }}" method="post">
            @csrf
            <button type="submit">Hoàn tất giao dịch</button>
        </form>

        <form action="{{ route('cancel') }}" method="post">
            @csrf
            <button type="submit">Hủy giao dịch</button>
        </form>
    </div>

    <script>
        window.onbeforeunload = function() {
            @if(Session::has('transaction'))
                return "Bạn có phiên giao dịch chưa hoàn tất, bạn có muốn thoát?";
            @endif
        };
    </script>
    
@endsection
