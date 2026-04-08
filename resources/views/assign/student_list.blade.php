@extends('layouts.app')
@section('content')

<div class="container mt-4">
    <h3 class="mb-4 text-success">Student Course Assignments</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Student</th>
                        <th>Assigned Courses</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td>
                                @if($student->studentCourses->isEmpty())
                                    <span class="text-muted">No courses assigned</span>
                                @else
                                    <ul class="mb-0">
                                        @foreach($student->studentCourses as $course)
                                            <li>{{ $course->title }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
