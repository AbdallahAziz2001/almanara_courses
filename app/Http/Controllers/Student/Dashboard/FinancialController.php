<?php

namespace App\Http\Controllers\Student\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\StudentLogController;
use App\Models\StudentFinancialData;
use App\Models\StudentRequest;
use Illuminate\Http\Request;

class FinancialController extends Controller
{
    function indexForStudent()
    {
        StudentLogController::setLog('The student opened his financial file page');
        $financials = StudentFinancialData::with(['student'])->where([
            ['students_id', '=', auth()->user()->id],
        ])->paginate(10);

        $requiredCount = StudentFinancialData::where([
            ['students_id', '=', auth()->user()->id],
        ])->sum('total_amount_required');
        $paidCount = StudentFinancialData::where([
            ['students_id', '=', auth()->user()->id],
        ])->sum('total_amount_paid');
        $payableCount = StudentFinancialData::where([
            ['students_id', '=', auth()->user()->id],
        ])->sum('total_amount_payable');

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
            'dashboard.students_dashboard.financials.index',
            [
                'financials' => $financials,
                'requiredCount' => $requiredCount,
                'paidCount' => $paidCount,
                'payableCount' => $payableCount,
                'studentHavePendingRequest' => $studentHavePendingRequest,
                'studentHaveAcceptRequest' => $studentHaveAcceptRequest,
            ]
        );
    }
}
