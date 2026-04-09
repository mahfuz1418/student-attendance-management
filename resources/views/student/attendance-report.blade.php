@extends('layouts.app')
@section('content')

<h3>My Attendance</h3>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Date</th>
            <th>Course</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($attendances as $att)
        <tr>
            <td>{{ $att->date }}</td>
            <td>{{ $att->course->name }}</td>
            <td>
                <span class="badge {{ $att->status == 'present' ? 'bg-success' : 'bg-danger' }}">
                    {{ ucfirst($att->status) }}
                </span>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">No attendance found</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection
