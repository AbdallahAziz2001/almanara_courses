<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\StudentLogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        if (Auth::guard('student')) {
            StudentLogController::setLog('The student has logged out of his account');
        }
        $guard = 'student';
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('dashboard.login');
    }
}
