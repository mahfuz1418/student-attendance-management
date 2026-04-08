@extends('layouts.app')
@section('content')
<h3>Attendance Report: {{ $course->name }}</h3>

<table class="table">
    <tr>
        <th>Date</th>
        <th>Student</th>
        <th>Status</th>
    </tr>
    @foreach($attendances as $att)
    <tr>
        <td>{{ $att->date }}</td>
        <td>{{ $att->student->name }}</td>
        <td>{{ ucfirst($att->status) }}</td>
    </tr>
    @endforeach
</table>
@endsection
