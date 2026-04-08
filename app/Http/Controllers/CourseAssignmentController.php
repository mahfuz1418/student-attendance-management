<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
class CourseAssignmentController extends Controller
{
    public function index() {
        $teachers = User::where('role', 'teacher')->with('teacherCourses')->get();
        $students = User::where('role', 'student')->with('studentCourses')->get();
        $courses = Course::all();
        return view('assign.index', compact('teachers', 'students', 'courses'));
    }

    public function assignTeacher(Request $request, $teacher_id) {
        $request->validate([
            'course_ids' => 'array',
            'course_ids.*' => 'exists:courses,id'
        ]);

        $teacher = User::findOrFail($teacher_id);
        $teacher->teacherCourses()->sync($request->course_ids ?? []); // empty array removes all
        return redirect()->back()->with('success', 'Teacher courses updated successfully.');
    }

    public function assignStudent(Request $request, $student_id) {
        $request->validate([
            'course_ids' => 'array',
            'course_ids.*' => 'exists:courses,id'
        ]);

        $student = User::findOrFail($student_id);
        $student->studentCourses()->sync($request->course_ids ?? []);
        return redirect()->back()->with('success', 'Student courses updated successfully.');
    }
}
