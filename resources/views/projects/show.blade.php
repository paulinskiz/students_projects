@extends('layouts.layout')
@section('content')

    <div class="container mt-5">
        <div class="row my-2">
            <div class="col">
                <p>Project: <strong> {{ $project->title }}</strong></p>
                <p>Number of groups: <strong> {{ $project->groups }}</strong></p>
                <p>Students per group: <strong> {{ $project->students_group }}</strong></p>

                <a href=" {{route('projects.index')}} " class="btn btn-secondary">Back to projects list</a>
            </div>
        </div>

        {{-- Students table --}}
        <div class="row my-4">
            <div class="col-5">
                <h1>Students</h1>
                @if ($project->students->isEmpty())
                    <h3>There are no students</h3>
                @else
                <table class="table table-bordered text-center">
                    <thead class="table-secondary">
                        <th>Student</th>
                        <th>Group</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($project->students as $student)
                        <tr>
                            <td>{{ $student->full_name }}</td>
                            <td>
                                {{-- find the students group and show group number --}}
                                @php
                                    $group = $student->groups()->where('student_id', $student->id)->where('project_id', $project->id)->first();
                                @endphp
                                @if ($group)
                                    Group #{{$group->number}}
                                @else
                                -
                                @endif

                            </td>
                            <td>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="project_id" value="{{$project->id}}">
                                    <input type="hidden" name="student_id" value="{{$student->id}}">
                                    <input type="hidden" name="group_id" 
                                        value="@if ($group){{$group->id}}@endif">
                                    <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                                    {{-- <button type="submit">Delete</button> --}}
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif

                <a href="{{ route('students.add', $project->id) }}" class="btn btn-secondary">Add new student</a>
            </div>
        </div>

        {{-- Groups tables --}}
        <div class="col-5">
            <div class="row my-4">
                <h1>Groups</h1>

                {{-- table for each group --}}
                
                @for ($i=1; $i<=$project->groups; $i++)
                    <div class="col-5 me-3">
                        <table class="table table-bordered text-center">
                            <thead class="table-secondary">
                                <tr>
                                    <th>Group #{{$i}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    // find all assigned students for each group
                                    $groups = $project->groups()->get();
                                    $group = $groups->where('number', $i)->first();
                                    $students = $group->students()->get();
                                    $studentsArr = [];
                                    foreach ($students as $student){
                                        array_push($studentsArr, $student);
                                    }
                                @endphp
                                {{-- max rows for max students per group --}}
                                @for ($j=0; $j<$project->students_group; $j++)
                                
                                {{-- show students name if student is attached to a group --}}
                                @if ($group->students()->count() > $j)
                                    <tr>
                                        <td>
                                            
                                            <form action="{{route('groups.unsign')}}" method="POST">
                                                @csrf
                                                {{$studentsArr[$j]->full_name}} 
                                                <input type="hidden" name="student_id" value="{{$studentsArr[$j]->id}}">
                                                <input type="hidden" name="group_id" value="{{$studentsArr[$j]->groups()->where('project_id', $project->id)->first()->group_id}}">
                                                <input type="submit" value="X" class="btn btn-sm btn-outline-danger">
                                            </form>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="p-0">
                                            <form action="{{route('groups.assign')}}" onchange="submit();" method="POST">
                                                @csrf
                                                {{-- Select only unsigned students --}}
                                                <select name="full_name" class="form-select" style="border: 1px solid black; margin: 2px 0px">
                                                    <option value="">Assign student</option>
                                                    @foreach ($project->students as $student)
                                                        @if (!$student->groups()->where('project_id', $project->id)->exists())
                                                            <option value="{{$student->full_name}}">{{$student->full_name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="project_id" value="{{$project->id}}">
                                                <input type="hidden" name="number" value="{{$i}}">
                                            </form>
                                        </td>
                                    </tr>  
                                @endif
                                
                                @endfor
                            </tbody>
                        </table>
                    </div>
                @endfor
            </div>
        </div>
    </div>
@endsection

