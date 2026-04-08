@extends('layouts.app')
@section('content')
<h3>{{ isset($course) ? 'Edit Course' : 'Add Course' }}</h3>

<form method="POST" action="{{ isset($course) ? route('courses.update', $course->id) : route('courses.store') }}">
    @csrf
    @if(isset($course))
        @method('PUT')
    @endif
    <div class="mb-3">
        <label for="name" class="form-label">Course Name</label>
        <input type="text" name="name" class="form-control" value="{{ $course->name ?? '' }}" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" class="form-control">{{ $course->description ?? '' }}</textarea>
    </div>
    <button type="submit" class="btn btn-success">{{ isset($course) ? 'Update' : 'Add' }}</button>
</form>
@endsection
