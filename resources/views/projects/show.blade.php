@extends('layouts.layout')
@section('content')
<p>Project: <strong> {{ $project->title }}</strong></p>
<p>Number of groups: <strong> {{ $project->groups }}</strong></p>
<p>Students per group: <strong> {{ $project->students_group }}</strong></p>

    <br>
    <a href=" {{route('projects.index')}} ">Back to list</a>
    
    {{-- Students table --}}
    <h1>Students</h1>
    <table>
        @if ($project->students->isEmpty())
            <h3>There are no students</h3>

        @else
        <thead>
            <th>Student</th>
            <th>Group</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($project->students as $student)
            <tr>
                <td>{{ $student->full_name }}</td>
                @php
                    $groups = $student->groups()->where('student_id', $student->id)->get();
                    $group = $groups->where('project_id', $project->id)->first();
                @endphp
                <td>
                    @if ($group)
                        {{$group->number}}
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
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    <a href="{{ route('students.add', $project->id) }}">Add new student</a>

    {{-- Groups tables --}}
    <h1>Groups</h1>
    @if ($message = Session::get('error'))
        <p>{{$message}}</p>
    @endif
    @for ($i=1; $i<=$project->groups; $i++)

        <table>
            <thead>
                <tr>
                    <th>Group #{{$i}}</th>
                </tr>
            </thead>
            <tbody>
                @for ($j=1; $j<=$project->students_group; $j++)
                @php
                    $groups = $project->groups()->get();
                    $group = $groups->where('number', $i)->first();
                    $students = $group->students()->get();
                    $studentsArr = [];
                    foreach ($students as $student){
                        array_push($studentsArr, $student->full_name);
                    }
                @endphp
                @if ($group->students()->count() >= $j)
                    <tr>
                        <td>{{$studentsArr[$j-1]}}</td>
                    </tr>
                @else
                    <tr>
                        <td>
                            <form action="{{route('groups.assign')}}" onchange="submit();" method="POST">
                                @csrf
                                <select name="full_name">
                                    <option value="">Assign student</option>
                                    @foreach ($project->students as $student)
                                        <option value="{{$student->full_name}}">{{$student->full_name}}</option>
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
    @endfor
@endsection

