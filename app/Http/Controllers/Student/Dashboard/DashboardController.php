<?php

namespace App\Http\Controllers\Student\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\StudentLogController;
use App\Models\User;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        StudentLogController::setLog('The user has opened the home page');
        $adminsCount = User::count();

        return response()->view(
            'dashboard.students_dashboard.home',
            [
                'adminsCount' => $adminsCount,
            ]
        );
    }
}
