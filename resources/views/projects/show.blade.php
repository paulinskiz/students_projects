@extends('layouts.layout')
@section('content')
<p>Project: <strong> {{ $project->title }}</strong></p>
<p>Number of groups: <strong> {{ $project->groups }}</strong></p>
<p>Students per group: <strong> {{ $project->groups }}</strong></p>

    <br>
    <a href=" {{route('projects.index')}} ">Back to list</a>
    
@endsection