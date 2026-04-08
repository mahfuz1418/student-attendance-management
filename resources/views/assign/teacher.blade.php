@extends('layouts.app')
@section('content')

<div class="container mt-4">
    <h3 class="mb-4 text-primary">Assign Courses to Teacher</h3>

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
            <form action="{{ route('assign.teacher') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="teacher_id" class="form-label fw-bold">Select Teacher</label>
                    <select name="teacher_id" id="teacher_id" class="form-select" required>
                        <option value="" disabled selected>-- Choose Teacher --</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
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

                <button type="submit" class="btn btn-primary w-100">Assign Courses</button>
            </form>
        </div>
    </div>
</div>

@endsection
