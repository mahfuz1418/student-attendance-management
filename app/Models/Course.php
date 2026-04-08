<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name'];

    // Teachers assigned
    public function teachers() {
        return $this->belongsToMany(User::class, 'course_teacher', 'course_id', 'teacher_id');
    }

    // Students assigned
    public function students() {
        return $this->belongsToMany(User::class, 'course_student', 'course_id', 'student_id');
    }
}
