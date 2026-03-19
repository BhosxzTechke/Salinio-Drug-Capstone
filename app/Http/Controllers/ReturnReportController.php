<?php

namespace App\Http\Controllers;

use App\Models\ReturnRequest;
use Illuminate\Http\Request;

class ReturnReportController extends Controller
{
    //


public function summary()
{
    $totalReturns = ReturnRequest::count();
    $refunded = ReturnRequest::where('status', 'refunded')->count();
    $rejected = ReturnRequest::where('status', 'rejected')->count();
    $pending = ReturnRequest::where('status', 'pending')->count();
    $totalRefundAmount = ReturnRequest::sum('refund_amount');

    $returns = ReturnRequest::with([
        'order.customer',
        'order.orderDetails.product'
    ])->latest()->get();

    return view('Reports.returned.return_summary', compact(
        'totalReturns',
        'refunded',
        'rejected',
        'pending',
        'totalRefundAmount',
        'returns'
    ));
}


}
