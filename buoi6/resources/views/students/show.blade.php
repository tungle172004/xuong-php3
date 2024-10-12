@extends('masster')

@section('content')
<div class="container">
    <h1>Chi tiết sinh viên: {{ $student->name }}</h1>
    <p>Email: {{ $student->email }}</p>
    <p>Lớp học: {{ $student->classroom->name }}</p>

    <h3>Thông tin hộ chiếu</h3>
    @if($student->passport)
        <p>Số hộ chiếu: {{ $student->passport->passport_number }}</p>
        <p>Ngày cấp: {{ $student->passport->issued_date }}</p>
        <p>Ngày hết hạn: {{ $student->passport->expiry_date }}</p>
    @else
        <p>Không có thông tin hộ chiếu.</p>
    @endif

    <h3>Môn học đã đăng ký</h3>
    <ul>
        @foreach($student->subjects as $subject)
            <li>{{ $subject->name }}</li>
        @endforeach
    </ul>

    <a href="{{ route('students.index') }}" class="btn btn-secondary">Quay lại</a>
</div>
@endsection
