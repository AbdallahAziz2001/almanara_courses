<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentPersonalInformation;
use App\Models\StudentRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentPersonalInformationController extends Controller
{
    function indexForStudent()
    {
        StudentLogController::setLog('The student opened his personal information page');
        $informations = StudentPersonalInformation::with(['student'])->where([
            ['students_id', '=', auth()->user()->id],
        ])->first();

        $studentRequestPending = StudentRequest::where([
            ['students_id', '=', auth()->user()->id],
            ['request', '=', 'Pending'],
        ])->first();

        $studentRequestAccepted = StudentRequest::where([
            ['students_id', '=', auth()->user()->id],
            ['request', '=', 'Accepted'],
        ])->first();

        $studentHavePendingRequest = $studentRequestPending == null ? false : true;
        $studentHaveAcceptRequest = $studentRequestAccepted == null ? false : true;

        return response()->view(
            'dashboard.students_dashboard.informations.index',
            [
                'informations' => $informations,
                'studentHavePendingRequest' => $studentHavePendingRequest,
                'studentHaveAcceptRequest' => $studentHaveAcceptRequest,
            ]
        );
    }

    public function edit()
    {
        StudentLogController::setLog('The student opened the page to edit his personal information');
        $informations = StudentPersonalInformation::with(['student'])->where([
            ['students_id', '=', auth()->user()->id],
        ])->first();

        return response()->view('dashboard.students_dashboard.informations.edit', ['informations' => $informations]);
    }

    public function update(Request $request)
    {
        StudentLogController::setLog('The student modified his personal information');
        $student = Student::where([
            ['id', '=', auth()->user()->id],
        ])->first();

        $informations = StudentPersonalInformation::where([
            ['students_id', '=', auth()->user()->id],
        ])->first();

        $validator = Validator($request->all(), [
            'first_name' => 'required|string|min:3|max:50',
            'last_name' => 'required|string|min:3|max:50',
            'email' => 'required|email|string|min:3|max:50|unique:students,email,' . $student->id,
            'account_picture' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'nid' => 'required|string|min:8|max:8',
            'address' => 'required|string|min:3|max:191',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:25|unique:student_personal_information,mobile,' . $informations->id,
            'gender' => 'nullable|in:Male,Female',
            'birthday' => 'nullable|date|date_format:Y-m-d',
            'study_level' => 'required',
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
            $informations->nid = $request->get('nid');
            $informations->address = $request->get('address');
            $informations->mobile = $request->get('mobile');
            $informations->gender = $request->get('gender');
            $informations->birthday = $request->get('birthday');
            $informations->study_level = $request->get('study_level');

            $studentIsUpdated = $student->update();
            $informationsIsUpdated = $informations->update();

            return response()->json(['message' => $studentIsUpdated && $informationsIsUpdated ? 'Student Profile Informations Updated Successfully' : 'Failed to Update Student Profile Informations'], $studentIsUpdated && $informationsIsUpdated ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function updateAccomplishments(Request $request)
    {
        StudentLogController::setLog('The student modified his accomplishments');
        $validator = Validator($request->all(), [
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }

        $studentPersonalInformation = StudentPersonalInformation::where([
            ['students_id', '=', auth()->user()->id],
        ])->first();

        $studentPersonalInformation->accomplishments = $request->input('content');
        $isSaved = $studentPersonalInformation->save();

        return response()->json([
            'message' => $isSaved ? 'Accomplishments Updated!' : 'Failed to update accomplishments, please try again.',
        ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    public function accomplishments(Request $request)
    {
        StudentLogController::setLog('The student opened the page for editing his accomplishments');
        $studentPersonalInformation = StudentPersonalInformation::where([
            ['students_id', '=', auth()->user()->id],
        ])->first();

        if ($studentPersonalInformation != null) {
            $studentPersonalInformationAccomplishments = $studentPersonalInformation->accomplishments;
        } else {
            $studentPersonalInformationAccomplishments = '';
        }
        return response()->view('dashboard.students_dashboard.informations.accomplishments', ['studentPersonalInformationAccomplishments' => $studentPersonalInformationAccomplishments]);
    }
}
