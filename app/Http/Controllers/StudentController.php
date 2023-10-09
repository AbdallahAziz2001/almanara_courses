<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentPersonalInformation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::paginate(10);
        return response()->view('dashboard.students.index', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('dashboard.students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'first_name' => 'required|string|min:3|max:50',
            'last_name' => 'required|string|min:3|max:50',
            'email' => 'required|email|string|min:3|max:50|unique:students,email',
            'password' => 'required|min:6|regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[*.!@$%^&(){}]).{8,}$/',
            'account_picture' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if (!$validator->fails()) {
            $student = new Student();
            $student->first_name = $request->get('first_name');
            $student->last_name = $request->get('last_name');
            $student->email = $request->get('email');
            $student->password = Hash::make($request->get('password'));

            if ($request->hasFile('account_picture')) {
                $image = $request->file('account_picture');
                $account_picture = time() . '_' . $student->first_name . '_' . $student->last_name . '.' . $image->getClientOriginalExtension();
                $request->file('account_picture')->storePubliclyAs('students', $account_picture, ['disk' => 'public']);
                $student->account_picture = $account_picture;
            } else {
                $student->account_picture = 'student_profile.png';
            }

            $isSaved = $student->save();

            $informations = new StudentPersonalInformation();
            $informations->students_id = $student->id;

            $informationsIsSaved = $informations->save();

            return response()->json(['message' => $isSaved ? 'Student Saved Successfully' : 'Failed to Save Student'], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $students = Student::where('id', '=', $student->id)->get();
        return response()->view('dashboard.students.index', ['students' => $students]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return response()->view('dashboard.students.edit', ['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validator = Validator($request->all(), [
            'first_name' => 'required|string|min:3|max:50',
            'last_name' => 'required|string|min:3|max:50',
            'email' => 'required|email|string|min:3|max:50|unique:students,email,' . $student->id,
            'account_picture' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if (!$validator->fails()) {
            $student->first_name = $request->get('first_name');
            $student->last_name = $request->get('last_name');
            $student->email = $request->get('email');
            if ($request->hasFile('account_picture')) {
                $image = $request->file('account_picture');
                $account_picture = time() . '_' . $student->first_name . '_' . $student->last_name . '.' . $image->getClientOriginalExtension();
                $request->file('account_picture')->storePubliclyAs('students', $account_picture, ['disk' => 'public']);
                $student->account_picture = $account_picture;
            }

            $isUpdated = $student->update();
            return response()->json(['message' => $isUpdated ? 'Student Updated Successfully' : 'Failed to Update Student'], $isUpdated ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $isDeleted = $student->delete();
        if ($isDeleted) {
            return response()->json(['title' => 'Student Deleted Successfully', 'icon' => 'success']);
        } else {
            return response()->json(['title' => 'Failed to Delete Student', 'icon' => 'danger']);
        }
    }
}
