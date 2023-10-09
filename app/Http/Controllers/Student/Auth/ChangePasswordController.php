<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\StudentLogController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function showChangePassword(Request $request)
    {
        if (Auth::guard('student')) {
            StudentLogController::setLog('The student opened the page to change his password');
        }
        return response()->view('dashboard.students_dashboard.auth.change-password');
    }

    public function changePassword(Request $request)
    {
        if (Auth::guard('student')) {
            StudentLogController::setLog('The student Changed his password');
        }
        $validator = Validator($request->all(), [
            'password' => 'required|min:8|regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[*.!@$%^&(){}]).{8,}$/',
            'new_password' => 'required_with:password|min:8|regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[*.!@$%^&(){}]).{8,}$/|confirmed',
        ]);

        if (!$validator->fails()) {
            $student = $request->user('student');
            $student->password = Hash::make($request->get('new_password'));
            $isSaved = $student->save();
            return response()->json(['message' => $isSaved ? 'Password changed successfully' : 'Failed to change password'], Response::HTTP_OK);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }
}
