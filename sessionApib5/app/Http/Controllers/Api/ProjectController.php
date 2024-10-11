<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Project::query()->latest('id')->paginate(5);
        // dd($data);
        return response()->json(['data'=>$data]);
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'project_name'    => 'required|max:255' ,
            'description'     => 'nullable' ,
            'start_date'      => 'required|date' ,
        ]);
        // dd($data);
        try {
            $project = Project::query()->create($data);

            return response()->json($project,201);
        } catch (\Throwable $th) {
            return response()->json(['message',$th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::find($id);
        if($project){
            return response()->json($project,201);
        }else{
            return response()->json('Không tìm thất bản ghi có id: '.$id);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'project_name'    => 'required|max:255' ,
            'description'     => 'nullable' ,
            'start_date'      => 'required|date' ,
        ]);
        $project = Project::find($id);
        if(!$project){
            return response()->json('không tìm thấy bản ghi có id:'.$id);
        }
        try {
            $project->update($data);

            return response()->json($project,201);
        } catch (\Throwable $th) {
            return response()->json(['message',$th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::find($id);
        if ($project) {
            Project::destroy($project);
            return response()->json([],204);
        }else{
            return response()->json('Không tìm thấy bản ghi có id: '.$id,404);
        };
    }
}
