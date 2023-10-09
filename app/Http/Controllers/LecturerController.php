<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lecturers = Lecturer::paginate(10);
        return response()->view('dashboard.lecturers.index', ['lecturers' => $lecturers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('dashboard.lecturers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'first_name' => 'required|string|min:3|max:50',
            'last_name' => 'required|string|min:3|max:50',
        ]);

        if (!$validator->fails()) {
            $lecturer = new Lecturer();
            $lecturer->first_name = $request->get('first_name');
            $lecturer->last_name = $request->get('last_name');

            $isSaved = $lecturer->save();

            return response()->json(['message' => $isSaved ? 'Lecturer Saved Successfully' : 'Failed to Save Lecturer'], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Lecturer $lecturer)
    {
        $lecturers = Lecturer::where('id', '=', $lecturer->id)->get();
        return response()->view('dashboard.lecturers.index', ['lecturers' => $lecturers]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lecturer $lecturer)
    {
        return response()->view('dashboard.lecturers.edit', ['lecturer' => $lecturer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lecturer $lecturer)
    {
        $validator = Validator($request->all(), [
            'first_name' => 'required|string|min:3|max:50',
            'last_name' => 'required|string|min:3|max:50',
        ]);

        if (!$validator->fails()) {
            $lecturer->first_name = $request->get('first_name');
            $lecturer->last_name = $request->get('last_name');

            $isUpdated = $lecturer->update();

            return response()->json(['message' => $isUpdated ? 'Lecturer Updated Successfully' : 'Failed to Update Lecturer'], $isUpdated ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lecturer $lecturer)
    {
        $isDeleted = $lecturer->delete();
        if ($isDeleted) {
            return response()->json(['title' => 'Lecturer Deleted Successfully', 'icon' => 'success']);
        } else {
            return response()->json(['title' => 'Failed to Delete Lecturer', 'icon' => 'danger']);
        }
    }
}
