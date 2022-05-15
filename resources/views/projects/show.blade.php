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
                <td>Group #</td>
                <td>
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="project_id" value="{{$project->id}}">
                        <input type="hidden" name="student_id" value="{{$student->id}}">
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
    
    @for ($i=1; $i<=$project->groups; $i++)
        <table>
            <thead>
                <tr>
                    <th>Group #{{$i}}</th>
                </tr>
            </thead>
            <tbody>
                @for ($j=1; $j<=$project->students_group; $j++)
                <tr>
                    <td>
                        <form action="">
                            <select name="full_name">
                                <option value="">Assign student</option>
                                @foreach ($project->students as $student)
                                    <option value="full_name">{{$student->full_name}}</option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
    @endfor

@endsection