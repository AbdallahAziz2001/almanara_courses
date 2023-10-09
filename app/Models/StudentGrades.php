<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGrades extends Model
{
    use HasFactory;

    public function student()
    {
        return $this->belongsTo(Student::class, 'students_id', 'id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'courses_id', 'id');
    }
}
