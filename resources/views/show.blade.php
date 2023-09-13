@extends('layouts.app')
@section('title', $task->title)
@section('content')
<nav class="mb-4">
    <a href="{{ route('tasks.index')}}" class="link"> <- Go back to main Task </a>
</nav>
<p class="text-slate-700 mb-4">{{ $task->description }}</p>
<p class="text-slate-700 mb-4">{{ $task->long_description }}</p>
<p class="mb-4 text-sm text-slate-500"> Created at {{ $task->created_at->diffForHumans() }}   {{ $task->updated_at->diffForHumans() }}</p>

@if ($task->completed)
    <span class="font-medium text-green-500">Completed!</span>
@else
    <span class="font-medium text-red-500">Not completed!</span>
@endif

<div class="flex gap-2 mt-3">
    <a href="{{ route('tasks.edit', ['task' => $task])}}" class="btn">
        <button type="submit">Edit</button>
    </a>

    <form method="POST" action="{{ route('task.toogle', ['task' => $task])}}">
        @csrf
        @method('PUT')
        <button type="submit" class="btn">Mark as {{ $task->completed ? 'not completed' : 'completed'}}</button>
    </form>
    <form method="POST" action="{{ route('task.destroy', ['task' => $task])}}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn">Delete</button>
    </form>
</div>
@endsection