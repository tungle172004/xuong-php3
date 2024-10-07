@extends('masster')

@section('title')
    <p>Danh sách nhân viên</p>
@endsection

@section('content')
    <h1>Danh sách nhân viên</h1>
    <a href="{{ route('employees.create') }}" class="btn btn-primary">Thêm nhân viên</a>
    <div class="table-responsive">
        <table class="table table-primary fluid">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">first_name</th>
                    <th scope="col">last_name</th>
                    <th scope="col">email </th>
                    <th scope="col">phone</th>
                    <th scope="col">date_of_birth</th>
                    <th scope="col">hire_date</th>
                    <th scope="col">salary</th>
                    <th scope="col">is_active(Trạng thái hoạt động)</th>
                    <th scope="col">department_id</th>
                    <th scope="col">manager_id</th>
                    <th scope="col">address</th>
                    <th scope="col">profile_picture</th>
                    <th scope="col">created_at</th>
                    <th scope="col">updated_at</th>

                    <th scope="col"></th>

                </tr>
            </thead>
            <tbody>
                @foreach ($data as $employee)
                    <tr class="">
                        <td scope="row">{{ $employee->id }}</td>
                        <td>{{ $employee->first_name }}</td>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>{{ $employee->date_of_birth }}</td>
                        <td>{{ $employee->hire_date }}</td>
                        <td>{{ $employee->salary }}</td>
                        <td>
                            @if ($employee->is_active)
                                <p class="badge bg-success">on</p>
                            @else
                                <p class="badge bg-danger">off</p>
                            @endif
                        </td>
                        <td>{{ $employee->department_id }}</td>
                        <td>{{ $employee->manager_id }}</td>
                        <td>{{ $employee->address }}</td>
                        <td>
                            @if ($employee->profile_picture)
                                <img src="data:image;base64,{{ $employee->profile_picture }}" width="100px">
                            @endif
                        </td>
                        <td>{{ $employee->created_at }}</td>
                        <td>{{ $employee->updated_at }}</td>

                        <td>
                            <a href="{{ route('employees.show', $employee) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-primary">edit</a>
                            <form action="{{ route('employees.destroy',$employee)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-warning" onclick="return confirm('Bạn có muốn bỏ vào thùng rác')">XM</button>
                            </form>
                            <form action="{{ route('employees.forcedestroy',$employee)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có muốn Xóa vĩnh viễn')">Xc</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    </div>
@endsection
