@extends('layouts.app')
@section('content')

<div class="container mt-4">
    <h3 class="mb-4 text-success">Assign Courses to Student</h3>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('assign.student') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="student_id" class="form-label fw-bold">Select Student</label>
                    <select name="student_id" id="student_id" class="form-select" required>
                        <option value="" disabled selected>-- Choose Student --</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="course_ids" class="form-label fw-bold">Select Courses</label>
                    <select name="course_ids[]" id="course_ids" class="form-select" multiple required>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted">Hold Ctrl (Windows) or Command (Mac) to select multiple courses.</small>
                </div>

                <button type="submit" class="btn btn-success w-100">Assign Courses</button>
            </form>
        </div>
    </div>
</div>

@endsection
