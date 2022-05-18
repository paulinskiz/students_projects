@extends('layouts.layout')
@section('content')

    <div class="container mt-5">
        <h3>Add new student for "{{$project->title}}" project</h3>

        <div class="row">
            <div class="col-3">
                <form action="{{route('students.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="full_name" class="form-label">Students full name:</label>
                        <input type="text" name="full_name" class="form-control">
                        @error('full_name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                        {{-- show error if student is added to a project already --}}
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @endif
                        <input type="hidden" name="project_id" value="{{$project->id}}">
                    </div>
                    <input type="submit" value="Add Student" class="btn btn-primary">
                </form>
            </div>
        </div>

        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-secondary mt-2">Go back to project</a>
    </div>

@endsection