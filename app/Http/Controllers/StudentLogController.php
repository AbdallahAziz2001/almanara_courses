<?php

namespace App\Http\Controllers;

use App\Models\StudentLog;
use App\Models\StudentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StudentLogController extends Controller
{
    public static function setLog(string $report)
    {
        $studentLog = new StudentLog();
        $studentLog->students_id = auth()->user()->id;
        $studentLog->report = $report;
        $studentLog->save();
    }

    public function index()
    {
        StudentLogController::setLog('The student opened his log page');
        $logs = StudentLog::where([
            ['students_id', '=', auth()->user()->id]
        ])->get();

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
            'dashboard.students_dashboard.logs.index',
            [
                'logs' => $logs,
                'studentHavePendingRequest' => $studentHavePendingRequest,
                'studentHaveAcceptRequest' => $studentHaveAcceptRequest,
            ]
        );
    }
}
