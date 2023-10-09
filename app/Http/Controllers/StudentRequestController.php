<?php

namespace App\Http\Controllers;

use App\Models\StudentRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = StudentRequest::with('student')->paginate(10);
        return response()->view('dashboard.requests.index', ['requests' => $requests]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentRequest $adminrequest)
    {
        $validator = Validator($request->all(), [
            'request' => 'required|in:Accepted,Canceled',
        ]);

        if (!$validator->fails()) {
            $adminrequest->request = $request->get('request');
            $adminrequest->expired_at = Carbon::now()->addDay();
            $isUpdated = $adminrequest->update();

            return response()->json(['message' => $isUpdated ? 'Student Request Updated Successfully' : 'Failed to Update Student Request'], $isUpdated ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function store(Request $request)
    {
        StudentLogController::setLog('The student requested to view all his personal and financial information, grades, and log history');
        $validator = Validator($request->all(), [
            'request' => 'required|in:Pending',
        ]);

        if (!$validator->fails()) {
            $studentRequest = new StudentRequest();

            $studentRequest->students_id = auth()->user()->id;
            $studentRequest->request = $request->get('request');
            $studentRequest->expired_at = null;

            $isSaved = $studentRequest->save();

            return response()->json(['message' => $isSaved ? 'Student Request Saved Successfully' : 'Failed to Save Student Request'], Response::HTTP_OK);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }
}
