@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- REQUIRED -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@section('content')

<h3>Course Assignment</h3>
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<!-- Tabs -->
<ul class="nav nav-tabs mb-3">
  <li class="nav-item">
    <a class="nav-link active" data-bs-toggle="tab" href="#teachers">Teachers</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#students">Students</a>
  </li>
</ul>

<div class="tab-content">
  <!-- Teachers -->
  <div class="tab-pane fade show active" id="teachers">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Teacher</th>
          <th>Assign Courses</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($teachers as $teacher)
        <tr>
          <td>{{ $teacher->name }}</td>
          <td>
            <form action="{{ route('assign.teacher.update', $teacher->id) }}" method="POST">
              @csrf
              <select name="course_ids[]" multiple class="form-select select2">
                @foreach($courses as $course)
                  <option value="{{ $course->id }}"
                    {{ $teacher->teacherCourses->contains($course->id) ? 'selected' : '' }}>
                    {{ $course->name }}
                  </option>
                @endforeach
              </select>
          </td>
          <td>
              <button type="submit" class="btn btn-primary btn-sm">Update</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- Students -->
  <div class="tab-pane fade" id="students">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Student</th>
          <th>Assign Courses</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($students as $student)
        <tr>
          <td>{{ $student->name }}</td>
          <td>
            <form action="{{ route('assign.student.update', $student->id) }}" method="POST">
              @csrf
              <select name="course_ids[]" multiple class="form-select select2">
                @foreach($courses as $course)
                  <option value="{{ $course->id }}"
                    {{ $student->studentCourses->contains($course->id) ? 'selected' : '' }}>
                    {{ $course->name }}
                  </option>
                @endforeach
              </select>
          </td>
          <td>
              <button type="submit" class="btn btn-primary btn-sm">Update</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection

<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Select courses",
        allowClear: true
    });
});
</script>
