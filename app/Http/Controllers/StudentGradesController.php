<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\StudentGrades;
use App\Models\StudentRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentGradesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = StudentGrades::with(['student', 'course'])->paginate(10);
        return response()->view('dashboard.grades.index', ['grades' => $grades]);
    }
    /**
     * Display a listing of the resource.
     */
    public function indexForStudent()
    {
        StudentLogController::setLog('The student opened his grades page');
        $grades = StudentGrades::with(['student', 'course', 'course.lecturer'])->where([
            ['students_id', '=', auth()->user()->id],
        ])->orderBy('semester')->paginate(10);

        $studentRequestPending = StudentRequest::where([
            ['students_id', '=', auth()->user()->id],
            ['request', '=', 'Pending'],
        ])->first();

        $studentRequestAccepted = StudentRequest::where([
            ['students_id', '=', auth()->user()->id],
            ['request', '=', 'Accepted'],
        ])->first();

        $studentHavePendingRequest = $studentRequestPending == null ? false : true;
        $studentHaveAcceptRequest = $studentRequestAccepted == null ? false : true;;

        return response()->view(
            'dashboard.students_dashboard.grades.index',
            [
                'grades' => $grades,
                'studentHavePendingRequest' => $studentHavePendingRequest,
                'studentHaveAcceptRequest' => $studentHaveAcceptRequest,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::get();
        $courses = Course::get();
        return response()->view('dashboard.grades.create', ['students' => $students, 'courses' => $courses]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'students_id' => 'required|int|exists:students,id',
            'courses_id' => 'required|int|exists:courses,id',
            'year_id' => 'required|int',
            'semester_id' => 'required|int',
            'course_grade' => 'required|numeric|min:0|max:100',
        ]);

        if (!$validator->fails()) {
            $studendGrade = new StudentGrades();
            $studendGrade->students_id = $request->get('students_id');
            $studendGrade->courses_id = $request->get('courses_id');
            $studendGrade->semester = $request->get('year_id') . $request->get('semester_id');
            $studendGrade->course_grade = $request->get('course_grade');

            $isSaved = $studendGrade->save();

            return response()->json(['message' => $isSaved ? 'Student Garde Saved Successfully' : 'Failed to Save Student Garde'], Response::HTTP_OK);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentGrades $grad)
    {
        $isDeleted = $grad->delete();

        if ($isDeleted) {
            return response()->json(['title' => 'Student Grades Deleted Successfully', 'icon' => 'success']);
        } else {
            return response()->json(['title' => 'Failed to Delete Student Grades', 'icon' => 'danger']);
        }
    }
}
