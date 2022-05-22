<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Student;

class GroupController extends Controller
{
    /**
     * Assign student to a single group of project
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assign(Request $request)
    {
        $request->validate([
            'project_id' => 'required',
            'number' => 'required',
            'full_name' => 'required',
        ]);

        $group = Group::where('project_id', $request->project_id)->where('number', $request->number)->first();
        $student = Student::where('full_name', $request->full_name)->first();

        // check if student id assigned already:
        $projectGroups = Group::where('project_id', $request->project_id)->get();
        foreach ($projectGroups as $projectGroup) {
            if ($projectGroup->students()->where('student_id', $student->id)->exists()){
                return redirect()->back()->with('error', 'This student assigned to a group already!');
            }
        }

        $student->groups()->attach($group->id);
        return redirect()->back();
    }

    /**
     * Unsign student from group of project
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function unsign(Request $request)
    {
        $student = Student::find($request->student_id);
        $student->groups()->detach($request->group_id);

        return redirect()->back();
    }
}
