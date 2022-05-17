@extends('layouts.layout')
@section('content')

    {{-- show error if student is added to a group already --}}
    @if ($message = Session::get('error'))
        <p>{{$message}}</p>
    @endif

    <h3>Add new student for "{{$project->title}}" project</h3>
    <form action="{{route('students.store')}}" method="POST">
        @csrf
        <label for="full_name">Students full name</label>
        <input type="text" name="full_name">
        <input type="hidden" name="project_id" value="{{$project->id}}">
        <input type="submit" value="Add">
    </form>

    <a href="{{ route('projects.show', $project->id) }}">Go back to project</a>

@endsection