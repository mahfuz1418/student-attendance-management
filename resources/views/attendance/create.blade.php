@extends('layouts.app')
@section('content')
<h3>Take Attendance for {{ $course->name }} ({{ $today }})</h3>

<form method="POST" action="{{ route('attendance.store', $course->id) }}">
    @csrf
    <table class="table">
        <tr>
            <th>Student</th>
            <th>Present</th>
            <th>Absent</th>
        </tr>
        @foreach($students as $student)
        <tr>
            <td>{{ $student->name }}</td>
            <td><input type="radio" name="statuses[{{ $student->id }}]" value="present" required></td>
            <td><input type="radio" name="statuses[{{ $student->id }}]" value="absent" required></td>
        </tr>
        @endforeach
    </table>
    <button class="btn btn-success">Submit Attendance</button>
</form>
@endsection
