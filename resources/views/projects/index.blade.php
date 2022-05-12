@extends('layouts.layout')
@section('content')
    <h1>Students Projects</h1>

    <a href="{{ route('projects.create') }}">Create new project</a>

    @if ($projects->isEmpty())
    <h3>There are no projects created</h3>

    @else
    <table>
        <tr>
            <th>Project Number</th>
            <th>Project Title</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($projects as $project)
            <tr>
                <td>{{ $project->id }}</td>
                <td>{{ $project->title }}</td>
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
    </table>

    @endif
    
@endsection