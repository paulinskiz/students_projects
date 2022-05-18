@extends('layouts.layout')
@section('content')

    <div class="container mt-5">
        <h1>Create new project</h1>
        <div class="row">
            <div class="col-4">
                <form action="{{ route('projects.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Project title</label>
                        <input type="text" name="title" class="form-control">
                        @error('title')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="groups" class="form-label">Number of groups</label>
                        <input type="text" name="groups" class="form-control">
                        @error('groups')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="students_group" class="form-label">Students per group</label>
                        <input type="text" name="students_group" class="form-control">
                        @error('students_group')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <input type="submit" value="Create" class="btn btn-primary">
                </form>
            </div>
        </div>
        <a href=" {{route('projects.index')}} " class="btn btn-secondary mt-2">Back to list</a>
    </div>
    
    
@endsection