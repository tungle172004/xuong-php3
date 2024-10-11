<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($projectId)
    {
        $data = Task::where('project_id',$projectId)->get();
        return response()->json($data,201);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
       try {
           $data = $request->validate([
                'task_name' => 'required|max:255',
                'description' => 'nullable|max:255'
            ]);
            $data['status'] = 'Chưa bắt đầu';
            // dd($data);
            $project = Project::find($id);
            // dd($project);
            if (!$project) {
                return response()->json(['msg' => 'Dự án không tồn tại'], 404);
            }

            $task = $project->tasks()->create($data);
            // dd($task);


            return response()->json($task,201);

       } catch (\Throwable $th) {
            return response()->json(['msg'=>'Lỗi hệ thống', $th->getMessage()], 500);
       }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::find($id);
        // dd($task);
        if($task){
            return response()->json($task,201);
        }else{
            return response()->json('Không tìm thấy bản ghi có id: '.$id);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $task = Task::find($id);

            $data = $request->validate([
                 'task_name' => 'required|max:255',
                 'description' => 'nullable|max:255',
                 'status' => 'nullable'
             ]);
             $data['status'] ??= 'Chưa thực hiện';

 
             $task->update($data);
 
             return response()->json($task,201);
 
        } catch (\Throwable $th) {
             return response()->json(['msg'=>'Lỗi hệ thống',$th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);
        if($task){
            Task::destroy($id);
            return response()->json([],204);
        }
        else{
            return response()->json('Không tìm thấy bản ghi có id: '.$id);
        }
    }
}
