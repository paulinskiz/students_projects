<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Student;

class GroupController extends Controller
{
    /**
     * Store a newly created resource in storage.
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

        $student->groups()->attach($group->id);
        return redirect()->back();
    }
}
