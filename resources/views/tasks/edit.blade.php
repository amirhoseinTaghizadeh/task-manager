@extends('layouts.admin')

@section('content')
    <h1>Edit Task</h1>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $task->title }}" required>
        </div>
        <div class="form-group">
            <label for="completed">Completed</label>
            <input type="checkbox" name="completed" id="completed" class="form-control" {{ $task->completed ? 'checked' : '' }}>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
