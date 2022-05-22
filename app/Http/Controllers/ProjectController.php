<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Group;
use App\Models\Student;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['projects'] = Project::orderBy('id', 'desc')->get();
        return view('projects.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
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
            'title' => 'required',
            'groups' => 'required|integer',
            'students_group' => 'required|integer',
        ]);

        $project = new Project;
        $project->title = $request->title;
        $project->groups = $request->groups;
        $project->students_group = $request->students_group;
        $project->save();

        // Create groups for projects:
        for($i=1; $i<=$request->groups; $i++){
            $group = new Group;
            $group->project_id = $project->id;
            $group->number = $i;
            $group->save();
        }

        return redirect()->route('projects.show', $project);
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('projects.show', compact(['project']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'groups' => 'required|numeric',
            'students_group' => 'required|numeric',
        ]);
        // update project:
        $project = Project::find($id);
        $project->title = $request->title;
        $project->groups = $request->groups;
        $project->students_group = $request->students_group;
        $project->save();

        // update groups:
        $groups = Group::where('project_id', $project->id)->get();
        $students = Student::get();
        foreach ($groups as $group){
            while ($group->students()->where('group_id', $group->id)->count() > $request->students_group){
                $group->students()->detach($group->students()->where('group_id', $group->id)->orderBy('id', 'desc')->first()->id);
            }
        }
        
        // delete groups if there is too much after update:
        if($groups->count() > $request->groups){
            for($i=$groups->count(); $i>$request->groups; $i--) {
                $groups[$i-1]->students()->detach();
                $group = $groups[$i-1];
                $group->delete();
            }
        }

        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource and everything with that resource from storage.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        // Detach students from project:
        $students = $project->students()->get();
        foreach ($students as $student) {
            $student->projects()->detach($project->id);
            $haveProject = $student->projects()->where('student_id', $student->id)->exists();
            if (!$haveProject){
                $student->delete();
            }
        }

        // delete groups from project:
        $groups = Group::where('project_id', $project->id)->get();
        foreach ($groups as $group) {
            $group->students()->detach();
            $group->delete();
        }
        
        // delete project:
        $project->delete();
        return redirect()->route('projects.index');
    }
}
