<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\StudentLogController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin(Request $request, $guard)
    {
        return response()->view('dashboard.students_dashboard.auth.login', ['guard' => $guard]);
    }

    public function login(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email|string|min:3|max:50|exists:students,email',
            'password' => 'required|min:8|regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[*.!@$%^&(){}]).{8,}$/',
            'guard' => 'required|in:student|string'
        ], [
            'guard.in' => 'Please, check url'
        ]);

        $credentials = ['email' => $request->get('email'), 'password' => $request->get('password')];
        if (!$validator->fails()) {
            if (Auth::guard($request->get('guard'))->attempt($credentials)) {
                StudentLogController::setLog('The student logged in to his account');
                return response()->route('students_dashboard.home');
            } else {
                return response()->json(['message' => 'Error Credentials, Please Try Again'], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }
}
