<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function add($id)
    {
        $project = Project::find($id);
        return view('students.add', ['project' => $project]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
        ]);

        $project = Project::find($request->project_id);
        $student = Student::where('full_name', $request->full_name)->first();

        $exist = false;
        if ($student){
            $exist = $student->projects()->where('project_id', $request->project_id)->exists();
        }

        if ($exist) {
            return redirect()->back()->with('error', 'This student exists in the project already');
        }

        if ($student){
            $student->projects()->attach($request->project_id);
            return redirect()->route('projects.show', compact('project'));
        }

        $student = new Student;
        $student->full_name = $request->full_name;        

        $student->save();
        $student->projects()->attach($request->project_id);
        return redirect()->route('projects.show', compact('project'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $student = Student::find($request->student_id);
        $student->projects()->detach($request->project_id);
        $haveProject = $student->projects()->where('student_id', $student->id)->exists();
        if (!$haveProject){
            $student->delete();
        }
        return redirect()->back();
    }
}
