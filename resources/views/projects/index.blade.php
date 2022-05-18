@extends('layouts.layout')
@section('content')
    <div class="container mt-5">
        <h1>Students Projects</h1>

        <a href="{{ route('projects.create') }}" class="btn btn-success">Create new project</a>

        {{-- Table for all projects --}}
        @if ($projects->isEmpty())
        <h3>There are no projects created</h3>

        @else
        <div class="row">
            <div class="col-5">
            <table class="table table-bordered rounded text-center mt-2">
                <thead class="table-secondary">
                    <tr>
                        <th>Project Started</th>
                        <th>Project Title</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->created_at }}</td>
                        <td><a href="{{ route('projects.show', compact('project')) }}" class="link-success">{{ $project->title }}</a></td>
                        <td>                        
                            <form action="{{ route('projects.destroy',$project->id) }}" method="Post">
                                <a href="{{ route('projects.edit',$project->id) }}" class="btn btn-success">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
        @endif
    </div>
@endsection