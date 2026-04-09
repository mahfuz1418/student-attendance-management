<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // Show courses assigned to the logged-in teacher
    public function showCourses() {
        $teacher = auth()->user();
        $courses = $teacher->teacherCourses; // From pivot relation
        return view('teacher.courses', compact('courses'));
    }

    // Show students of selected course for attendance
    public function showStudents(Course $course) {
        $students = $course->students;

        // Get today's attendance for this course
        $today = now()->toDateString();
        $attendanceRecords = Attendance::where('course_id', $course->id)
                                    ->where('date', $today)
                                    ->pluck('status', 'student_id')
                                    ->toArray(); // [student_id => 'present'/'absent']

        return view('teacher.attendance', compact('course', 'students', 'attendanceRecords'));
    }

    // Store attendance
    public function storeAttendance(Request $request, Course $course) {
        $request->validate([
            'attendance' => 'required|array',
            'attendance.*' => 'in:present,absent',
        ]);

        foreach($request->attendance as $student_id => $status) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $student_id,
                    'course_id' => $course->id,
                    'date' => now()->toDateString(),
                ],
                ['status' => $status]
            );
        }

        return redirect()->route('teacher.courses')->with('success', 'Attendance submitted successfully.');
    }

    public function report(Request $request)
    {
        $courses = Course::all();

        $query = Attendance::with(['student', 'course']);

        // Filter by course
        if ($request->course_id) {
            $query->where('course_id', $request->course_id);
        }

        // Filter by date
        if ($request->date) {
            $query->whereDate('date', $request->date);
        }

        $attendances = $query->latest()->get();

        return view('admin.attendance-report', compact('attendances', 'courses'));
    }

    public function teacherReport(Request $request)
    {
        $teacher = auth()->user();

        // Get teacher's assigned courses
        $courses = $teacher->teacherCourses;

        $query = Attendance::with(['student','course'])
            ->whereIn('course_id', $courses->pluck('id'));

        // Filter by course
        if ($request->course_id) {
            $query->where('course_id', $request->course_id);
        }

        // Filter by date
        if ($request->date) {
            $query->whereDate('date', $request->date);
        }

        $attendances = $query->latest()->get();

        return view('teacher.attendance-report', compact('attendances','courses'));
    }

    public function studentAttendance()
    {
        $student = auth()->user();

        $attendances = Attendance::with('course')
            ->where('student_id', $student->id)
            ->latest()
            ->get();

        return view('student.attendance-report', compact('attendances'));
    }
}
