@extends('masster')

@section('content')
    <h1>Sửa Học sinh có name là : {{$student->name}}</h1>
    @if (session()->has('success') && !session()->get('success'))
        <div class="alert alert-danger">
            <ul>
                {{ session()->get('error') }}
            </ul>
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

    <div class="container">
        <form method="POST" action="{{ route('students.update',$student)  }}">
            @csrf
            @method('PUT')
            <div class="mb-3 row">
                <label for="name" class="col-4 col-form-label">Name</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="name" id="name" placeholder="name"
                        value="{{ $student->name }}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-4 col-form-label">email</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="email" id="email" placeholder="email"
                        value="{{ $student->email }}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="passport_number" class="col-4 col-form-label">passport_number</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="passport_number" id="passport_number"
                        placeholder="passport_number" value="{{ optional($student->passport)->passport_number }}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="issued_date" class="col-4 col-form-label">Ngày cấp</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="issued_date" id="issued_date" placeholder="issued_date"
                        value="{{ optional($student->passport)->issued_date }}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="expiry_date" class="col-4 col-form-label">Ngày Hết hạn</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="expiry_date" id="expiry_date" placeholder="expiry_date"
                        value="{{ optional($student->passport)->expiry_date }}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="classroom_id" class="col-4 col-form-label">Lớp học</label>
                <select class="form-control" name="classroom_id" id="classroom_id" required>
                    
                    @foreach ($classroom as $classroom)
                        <option value="{{ $classroom->id }}" {{$classroom->id == $student->classroom_id ? 'selected' : ''}}>{{ $classroom->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 row">
                <label for="subjects" class="col-4 col-form-label">Môn học</label>
                <select name="subjects[]" class="form-control"  required>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}" {{in_array($subject->id, $student->subjects->pluck('id')->toArray()) ? 'selected' : ''}}>{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-primary">
                        Action
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
