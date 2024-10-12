<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Student::with(['classroom','passport','subjects'])
        ->when($request->input('search'), function($query) use ($request) {
            $query->where('name', 'LIKE', '%' . $request->input('search') . '%')
                  ->orWhereHas('classroom', function($q) use ($request) {
                      $q->where('name', 'LIKE', '%' . $request->input('search') . '%');
                  });
        })
        ->latest('id')
        ->paginate(5);
        return view('students.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classroom = Classroom::all();
        $subjects = Subject::all();
        return view('students.create' , compact('classroom','subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'classroom_id' => 'required|exists:classrooms,id',
            'passport_number' => 'nullable|string|unique:passports',
            'issued_date' => 'nullable|date',
            'expiry_date' => 'nullable|date',
            'subjects' => 'array',
        ]);
        try {
            $student = Student::create($validated);
            // dd($student);
            if($request->input('passport_number')){
                $student->passport()->create([
                    'passport_number' => $request->input('passport_number'),
                    'issued_date' =>$request->input('issued_date'),
                    'expiry_date' =>$request->input('expiry_date'),
                ]);
            }
            if($request->input('subjects')){
                $student->subjects()->attach($request->input('subjects'));
            }
            return redirect()->route('students.index')->with('success','Sinh viên đã được thêm thành công');
        } catch (\Throwable $th) {
            return back()->with('success',false)->with('error',$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('students.show',compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
       $classroom = Classroom::all();
       $subjects = Subject::all();
       return view('students.edit',compact('student','classroom','subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('students')
                ->ignore($student->id)
            ],
            'classroom_id' => 'required|exists:classrooms,id',
            'passport_number' => [
                'nullable',
                Rule::unique('passports')
                ->ignore(optional($student->passport)->id)
            ],
            'issued_date' => 'nullable|date',
            'expiry_date' => 'nullable|date',
            'subjects' => 'array',
        ]);
        try {
            $student->update($validated);
            if($request->input('subjects')){
                $student->subjects()->sync($request->subjects);
            }
            // dd($student);
            if($student->passport){
                $student->passport()->update([
                    'passport_number' => $request->input('passport_number'),
                    'issued_date' =>$request->input('issued_date'),
                    'expiry_date' =>$request->input('expiry_date'),
                ]);
            }else{
                $student->passport()->create([
                    'passport_number' => $request->input('passport_number'),
                    'issued_date' =>$request->input('issued_date'),
                    'expiry_date' =>$request->input('expiry_date'),
                ]);
            }
           
            return redirect()->route('students.index')->with('success','Sinh viên đã được Cập nhật thành công');
        } catch (\Throwable $th) {
            return back()->with('success',false)->with('error',$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->destroy($student->id);
        return redirect()->route('students.index')->with('success','Sinh viên được xóa thành công');
    }
}
