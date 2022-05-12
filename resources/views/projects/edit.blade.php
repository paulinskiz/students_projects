@extends('layouts.layout')
@section('content')
    <h1>Edit "{{$project->title}}" project</h1>

    <form action="{{ route('projects.update', $project->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Project title</label>
        <input type="text" name="title" value="{{ $project->title }}">
        @error('title')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
        @enderror
        <label for="groups">Number of groups</label>
        <input type="text" name="groups" value="{{ $project->groups }}">
        @error('groups')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
        @enderror
        <label for="students_group">Students per group</label>
        <input type="text" name="students_group" value="{{ $project->students_group }}">
        @error('students_group')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
        @enderror
        <input type="submit" value="Update">
    </form>
    <br>
    <a href=" {{route('projects.index')}} ">Back to list</a>

    
@endsection