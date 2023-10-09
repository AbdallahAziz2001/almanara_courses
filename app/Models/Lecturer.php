<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    use HasFactory;

    public function lecturerCourses()
    {
        return $this->hasMany(Course::class, 'lecturers_id', 'id');
    }
}
