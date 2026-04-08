@extends('layouts.app')
@section('content')

<h3>My Courses</h3>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<ul class="list-group">
    @foreach($courses as $course)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ $course->name }}
            <a href="{{ route('teacher.attendance.form', $course->id) }}" class="btn btn-primary btn-sm">
                Take Attendance
            </a>
        </li>
    @endforeach
</ul>

@endsection
