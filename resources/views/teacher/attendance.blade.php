@extends('layouts.app')
@section('content')

<h3>Attendance for {{ $course->name }}</h3>
<p><strong>Date:</strong> {{ now()->format('d M Y') }}</p>
<form action="{{ route('teacher.attendance.store', $course->id) }}" method="POST">
    @csrf
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Student</th>
                <th>Attendance</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>
                    <select name="attendance[{{ $student->id }}]" class="form-select" required>
                        <option value="present" {{ (isset($attendanceRecords[$student->id]) && $attendanceRecords[$student->id] == 'present') ? 'selected' : '' }}>Present</option>
                        <option value="absent" {{ (isset($attendanceRecords[$student->id]) && $attendanceRecords[$student->id] == 'absent') ? 'selected' : '' }}>Absent</option>
                    </select>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <button type="submit" class="btn btn-success">Submit Attendance</button>
</form>

@endsection
