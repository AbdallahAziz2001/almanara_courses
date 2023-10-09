<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function gradesStudents()
    {
        return $this->hasMany(StudentGrades::class, 'students_id', 'id');
    }

    public function financialsStudents()
    {
        return $this->hasMany(StudentFinancialData::class, 'students_id', 'id');
    }

    public function informationsStudents()
    {
        return $this->hasMany(StudentFinancialData::class, 'students_id', 'id');
    }

    public function studentRequests()
    {
        return $this->hasMany(StudentRequest::class, 'students_id', 'id');
    }

    public function studentLogs()
    {
        return $this->hasMany(StudentLog::class, 'students_id', 'id');
    }
}
