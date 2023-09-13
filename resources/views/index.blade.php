@extends('layouts.app')
@section('title', 'All Tasks')
@section('content')
    <nav class="mb-4">
        <a href="{{ route('tasks.create')}}" class="link"> Create Task </a>
    </nav>
    @forelse ($tasks as $task)
        <a  href="{{ route('tasks.show', ['task' => $task->id])}}" @class(['line-through' => $task->completed])><h4>{{ $task->title }}</h4></a>
    @empty
        <div>
            <p>There is no tasks</p>
        </div>
    @endforelse
    @if ($tasks->count())
        <div>
            {{ $tasks->links() }}
        </div>
    @endif
@endsection