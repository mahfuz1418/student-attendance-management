@extends('layouts.app')
@section('content')

<h3>Attendance Report</h3>

<!-- Filters -->
<form method="GET" class="row mb-3">
    <div class="col-md-4">
        <select name="course_id" class="form-select">
            <option value="">All Courses</option>
            @foreach($courses as $course)
                <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                    {{ $course->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <input type="date" name="date" class="form-control" value="{{ request('date') }}">
    </div>

    <div class="col-md-4">
        <button class="btn btn-primary">Filter</button>
    </div>
</form>

<!-- Table -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Date</th>
            <th>Course</th>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($attendances as $att)
        <tr>
            <td>{{ $att->date }}</td>
            <td>{{ $att->course->name }}</td>
            <td>{{ $att->student->id }}</td>
            <td>{{ $att->student->name }}</td>
            <td>
                <span class="badge {{ $att->status == 'present' ? 'bg-success' : 'bg-danger' }}">
                    {{ ucfirst($att->status) }}
                </span>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">No records found</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection
