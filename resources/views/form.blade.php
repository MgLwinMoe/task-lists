@extends('layouts.app')
@section('title', isset($task) ? 'Edit Task' : 'Create Task')
@section('styles')
@endsection
@section('content')
<form method="POST" action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.post') }}">
    @csrf
    @isset($task)
        @method('PUT')
    @endisset
    <div class="form-group mb-4">
        <label for="title">Title</label>
        <input type="text" id="title" @class(['border-red-500' => $errors->has('title')]) name="title" value="{{ $task->title ?? old('title')}}">
        @error('title')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group mb-4">
        <label for="description">Description</label>
        <textarea type="text" id="description" @class(['border-red-500' => $errors->has('description')]) rows="5" name="description">{{  $task->description ?? old('description')}}</textarea>
        @error('description')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group mb-4">
        <label for="long_description">Long Description</label>
        <textarea type="text" id="long_description" @class(['border-red-500' => $errors->has('long_description')]) rows="5" name="long_description">{{ $task->long_description ?? old('long_description')}}</textarea>
        @error('long_description')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group mb-4">
        <button type="submit" class="btn">
            @isset($task)
                Update Task
            @else
                Add Task
            @endisset
        </button>
        <a class="link" href="{{ route('tasks.index')}}">Cancle</a>
    </div>
</form>
@endsection