@extends('layouts.layout')
@section('content')
    <h1>Students Projects</h1>

    <a href="{{ route('projects.create') }}">Create new project</a>

    {{-- Table for all projects --}}
    @if ($projects->isEmpty())
    <h3>There are no projects created</h3>

    @else
    <table>
        <thead>
            <tr>
                <th>Project Start Date</th>
                <th>Project Title</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
            <tr>
                <td>{{ $project->created_at }}</td>
                <td><a href="{{ route('projects.show', compact('project')) }}">{{ $project->title }}</a></td>
                <td>                        
                    <form action="{{ route('projects.destroy',$project->id) }}" method="Post">
                        <a href="{{ route('projects.edit',$project->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @endif
@endsection