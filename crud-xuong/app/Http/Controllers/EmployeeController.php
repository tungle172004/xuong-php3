<?php

namespace App\Http\Controllers;

use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    const PATH_VIEW  = 'employees.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = employee::latest('id')->paginate(10);

        return view(self::PATH_VIEW . __FUNCTION__,compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name'        => 'required|max:100',
            'last_name'         => 'required|max:100',
            'email'             => [
                'required',
                'max:150',
                Rule::unique('employees'),
            ],
            'phone'             => 'required|max:15',
            'date_of_birth'     => 'required',
            'hire_date'         => 'required',
            'salary'            => 'required|numeric',
            'is_active'         => [
                'nullable',
                Rule::in([0,1]),
            ],
            'department_id'     => 'required', 
            'manager_id'        => 'required',
            'address'           => 'required',
            'profile_picture'   => 'nullable|image|max:2048',
        ]);

        try {
            if ($request->hasFile('profile_picture')) {
                $profilePicture = $request->file('profile_picture')->getRealPath();

                $data['profile_picture'] = base64_encode(file_get_contents($profilePicture));
            }
             employee::create($data);

            return redirect()->route('employees.index')->with('success',true);
        } catch (\Throwable $th) {
            Log::debug('Độ dài hình ảnh hồ sơ: ' . strlen($data['profile_picture']));

            return back()->with('success',false)->with('error',$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(employee $employee)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(employee $employee)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, employee $employee)
    {
        $data = $request->validate([
            'first_name'        => 'required|max:100',
            'last_name'         => 'required|max:100',
            'email'             => [
                'required',
                'max:150',
                Rule::unique('employees')->ignore($employee->id),
            ],
            'phone'             => 'required|max:15',
            'date_of_birth'     => 'required',
            'hire_date'         => 'required',
            'salary'            => 'required|numeric',
            'is_active'         => [
                'nullable',
                Rule::in([0,1]),
            ],
            'department_id'     => 'required', 
            'manager_id'        => 'required',
            'address'           => 'required',
            'profile_picture'   => 'nullable|image|max:2048',
        ]);

        try {
            if ($request->hasFile('profile_picture')) {
                $profilePicture = $request->file('profile_picture')->getRealPath();

                $data['profile_picture'] = base64_encode(file_get_contents($profilePicture));
            }
            else{
                $data['profile_picture']= $employee->profile_picture;
           }
           $employee->update($data);

            return redirect()->route('employees.index')->with('success',true);
        } catch (\Throwable $th) {
            Log::debug('Độ dài hình ảnh hồ sơ: ' . strlen($data['profile_picture']));

            return back()->with('success',false)->with('error',$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(employee $employee)
    {
       try {
        $employee->delete();
        return back()->with('success',true);
       } catch (\Throwable $th) {
        return back()
            ->with('success',false)
            ->with('error',$th->getMessage());
       }
    }
    public function forcedestroy(employee $employee)
    {
        try {
            $employee->forceDelete();
            return back()->with('success',true);
           } catch (\Throwable $th) {
            return back()
                ->with('success',false)
                ->with('error',$th->getMessage());
           }
    }
}
