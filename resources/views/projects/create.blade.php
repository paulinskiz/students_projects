@extends('layouts.layout')
@section('content')
    <h1>Create new project</h1>

    <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        <label for="title">Project title</label>
        <input type="text" name="title">
        @error('title')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
        @enderror
        <label for="groups">Number of groups</label>
        <input type="text" name="groups">
        @error('groups')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
        @enderror
        <label for="students_group">Students per group</label>
        <input type="text" name="students_group">
        @error('students_group')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
        @enderror
        <input type="submit">
    </form>
    <br>
    <a href=" {{route('projects.index')}} ">Back to list</a>
    
@endsection