<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\StudentPersonalInformation;
use App\Models\StudentRequest;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        $adminsCount = User::count();
        $lecturersCount = Lecturer::count();
        $studentCount = Student::count();
        $coursesCount = Course::count();
        $studenrRequestsCount = StudentRequest::count();
        return response()->view(
            'dashboard.home',
            [
                'adminsCount' => $adminsCount,
                'lecturersCount' => $lecturersCount,
                'studentCount' => $studentCount,
                'coursesCount' => $coursesCount,
                'studenrRequestsCount' => $studenrRequestsCount,
            ]
        );
    }
}
