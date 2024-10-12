@extends('masster')

@section('content')
    <h1>Quản lý sinh viên</h1>
    <a href="{{ route('students.create')}}" class="btn btn-primary">Thêm sinh viên</a>
    <div class="table-responsive">
        <form method="GET" action="{{ route('students.index') }}">
            <input type="text" name="search" placeholder="Tìm kiếm...">
            <button type="submit">Tìm kiếm</button>
        </form>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Id Student</th>
                    <th scope="col">Name Student</th>
                    <th scope="col">Email Student</th>
                    <th scope="col">class Student</th>
                    <th scope="col">Passport Student</th>
                    <th scope="col">Subject Student</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $student)
                    <tr class="">
                        <td scope="row">{{ $student->id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->classroom->name }}</td>
                        <td>{{ $student->passport ? $student->passport->passport_number : 'Không có hộ chiếu' }}</td>
                        <td>
                            @foreach ($student->subjects as $subject)
                                {{ $subject->name }},
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('students.show', $student) }} " class="btn btn-primary">Xem</a><br>
                            <a href="{{ route('students.edit', $student) }}" class="btn btn-warning">Sửa</a>
                            <form action="{{ route('students.destroy', $student) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn vứt vào thùng rác?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        {{$data->links()}}
    </div>
@endsection
