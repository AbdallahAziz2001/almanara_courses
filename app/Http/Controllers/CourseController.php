<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('lecturer')->paginate(10);
        return response()->view('dashboard.courses.index', ['courses' => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lecturers = Lecturer::get();
        return response()->view('dashboard.courses.create', ['lecturers' => $lecturers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'course' => 'required|string|min:9|max:9|unique:courses,course',
            'lecturers_id' => 'required|int|exists:lecturers,id',
        ]);

        if (!$validator->fails()) {
            $course = new Course();
            $course->course = $request->get('course');
            $course->lecturers_id = $request->get('lecturers_id');

            $isSaved = $course->save();

            return response()->json(['message' => $isSaved ? 'Course Saved Successfully' : 'Failed to Save Course'], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $courses = Course::where('id', '=', $course->id)->get();
        return response()->view('dashboard.courses.index', ['courses' => $courses]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $lecturers = Lecturer::get();
        return response()->view('dashboard.courses.edit', ['course' => $course, 'lecturers' => $lecturers]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validator = Validator($request->all(), [
            'course' => 'required|string|min:9|max:9|unique:courses,id,' . $course->id,
            'lecturers_id' => 'required|int|exists:lecturers,id',
        ]);

        if (!$validator->fails()) {
            $course->course = $request->get('course');
            $course->lecturers_id = $request->get('lecturers_id');

            $isUpdated = $course->update();
            return response()->json(['message' => $isUpdated ? 'Course Updated Successfully' : 'Failed to Update Course'], $isUpdated ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $isDeleted = $course->delete();
        if ($isDeleted) {
            return response()->json(['title' => 'Course Deleted Successfully', 'icon' => 'success']);
        } else {
            return response()->json(['title' => 'Failed to Delete Course', 'icon' => 'danger']);
        }
    }
}
