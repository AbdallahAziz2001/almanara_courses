<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin(Request $request)
    {
        return response()->view('dashboard.auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email|string|min:3|max:191',
            'password' => 'required|min:8|regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[*.!@$%^&(){}]).{8,}$/',
            'guard' => 'required|in:admin,student|string'
        ], [
            'guard.in' => 'Please, check url'
        ]);

        $credentials = ['email' => $request->get('email'), 'password' => $request->get('password')];
        if (!$validator->fails()) {
            if (Auth::guard($request->get('guard'))->attempt($credentials)) {
                if ($request->get('guard') == 'admin') {
                    return redirect()->route('dashboard.home');
                } else if ($request->get('guard') == 'student') {
                    return redirect()->route('students_dashboard.home');
                }
            } else {
                return response()->json(['message' => 'Error Credentials, Please Try Again'], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }
}
