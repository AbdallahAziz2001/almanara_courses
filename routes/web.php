<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\Student\Auth\ChangePasswordController as StudentChangePasswordController;
use App\Http\Controllers\Student\Auth\LogoutController as StudentLogoutController;
use App\Http\Controllers\Student\Dashboard\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\Dashboard\FinancialController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentGradesController;
use App\Http\Controllers\StudentLogController;
use App\Http\Controllers\StudentPersonalInformationController;
use App\Http\Controllers\StudentRequestController;
use App\Models\StudentLog;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('dashboard/')->middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLogin'])->name('dashboard.login');
    Route::post('{guard}/login', [LoginController::class, 'login']);
});





Route::prefix('dashboard/')->middleware('auth:admin')->group(function () {
    Route::get('home', [DashboardController::class, 'showDashboard'])->name('dashboard.home');

    Route::resource('admins', AdminController::class);
    Route::resource('lecturers', LecturerController::class);
    Route::resource('students', StudentController::class);
    Route::resource('courses', CourseController::class);

    Route::get('grades', [StudentGradesController::class, 'index'])->name('grades.index');
    Route::get('grades/create', [StudentGradesController::class, 'create'])->name('grades.create');
    Route::post('grades', [StudentGradesController::class, 'store'])->name('grades.store');
    Route::delete('grades/{grad}', [StudentGradesController::class, 'destroy'])->name('grades.destroy');

    Route::resource('adminrequests', StudentRequestController::class);

    Route::view('our-team', 'dashboard.our-team')->name('dashboard.our-team');

    Route::get('change-password', [ChangePasswordController::class, 'showChangePassword'])->name('dashboard.change-password');
    Route::post('change-password', [ChangePasswordController::class, 'changePassword']);

    Route::get('logout', [LogoutController::class, 'logout'])->name('dashboard.logout');
});





Route::prefix('dashboard/students/dashboard/')->middleware('auth:student')->group(function () {
    Route::get('home', [StudentDashboardController::class, 'showDashboard'])->name('students_dashboard.home');

    Route::get('grades', [StudentGradesController::class, 'indexForStudent'])->name('students_dashboard.grades.index');
    Route::get('financials', [FinancialController::class, 'indexForStudent'])->name('students_dashboard.financials.index');
    Route::get('informations', [StudentPersonalInformationController::class, 'indexForStudent'])->name('students_dashboard.informations.index');

    Route::get('informations/edit', [StudentPersonalInformationController::class, 'edit'])->name('students_dashboard.informations.edit');
    Route::put('informations', [StudentPersonalInformationController::class, 'update'])->name('students_dashboard.informations.update');
    Route::get('accomplishments', [StudentPersonalInformationController::class, 'accomplishments'])->name('students_dashboard.informations.accomplishments');
    Route::put('accomplishments', [StudentPersonalInformationController::class, 'updateAccomplishments'])->name('students_dashboard.informations.update-accomplishments');

    Route::post('requests', [StudentRequestController::class, 'store'])->name('requests.store');

    Route::get('logs', [StudentLogController::class, 'index'])->name('logs.index');

    Route::get('our-team', function () {
        StudentLogController::setLog('The student opened our team page');
        return view('dashboard.students_dashboard.our-team');
    })->name('students_dashboard.our-team');

    Route::get('change-password', [StudentChangePasswordController::class, 'showChangePassword'])->name('students_dashboard.change-password');
    Route::post('change-password', [StudentChangePasswordController::class, 'changePassword']);

    Route::get('logout', [StudentLogoutController::class, 'logout'])->name('students_dashboard.logout');
});
