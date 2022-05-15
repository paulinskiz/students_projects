<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Group;

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
            'groups' => 'required|numeric',
            'students_group' => 'required|numeric',
        ]);

        $project = new Project;
        $project->title = $request->title;
        $project->groups = $request->groups;
        $project->students_group = $request->students_group;
        $project->save();

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
        $groups = Group::with(['students'])->where("project_id", $project->id)->get();
        return view('projects.show', compact(['project', 'groups']));
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

        $project = Project::find($id);
        $project->title = $request->title;
        $project->groups = $request->groups;
        $project->students_group = $request->students_group;

        $project->save();

        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        Group::where('project_id', $project->id)->delete();

        return redirect()->route('projects.index');
    }
}
