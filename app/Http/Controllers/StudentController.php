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
     * Store a newly created resource in storage or attach if it is created .
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
        ]);
        
        // find the project and the student
        $project = Project::find($request->project_id);
        $student = Student::where('full_name', $request->full_name)->first();

        // find if student is assigned to a group in this project
        $exist = false;
        if ($student){
            $exist = $student->projects()->where('project_id', $request->project_id)->exists();
        }

        if ($exist) {
            return redirect()->back()->with('error', 'This student exists in the project already');
        }

        // if student exist, attach him to a project
        if ($student){
            $student->projects()->attach($request->project_id);
            return redirect()->route('projects.show', compact('project'));
        }

        // if student does not exist, store the student and attach him to project
        $student = new Student;
        $student->full_name = $request->full_name;        

        $student->save();
        $student->projects()->attach($request->project_id);
        return redirect()->route('projects.show', compact('project'));
    }

    /**
     * Remove the specified resource and everything with that resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // detach student from projetc and groups
        $student = Student::find($request->student_id);
        $student->groups()->detach($request->group_id);
        $student->projects()->detach($request->project_id);

        // remove student if does not have more attached projects
        $haveProject = $student->projects()->where('student_id', $student->id)->exists();
        if (!$haveProject){
            $student->delete();
        }

        return redirect()->back();
    }
}
