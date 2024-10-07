@extends('masster')

@section('title')
    <p>Thêm nhân viên</p>
@endsection

@section('content')
    <h1>Chi tiết nhân viên</h1>
    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    
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
                    <th scope="col">deleted_at</th>
                </tr>
            </thead>
            <tbody>
                
                    <tr class="">
                       
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
                        <td>{{ $employee->deleted_at }}</td>
                        
                    </tr>
                
            </tbody>
        </table>
    </div>
@endsection
