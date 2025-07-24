<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use App\Models\LeaveType;
use Auth;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function getLeaveTypes()
    {
        $data = LeaveType::select('id', 'name')->get();
        return sendResponse(200, 'success', $data);
    }

    public function createLeave(Request $request)
    {
        $leave = Leave::create([
            'user_id' => Auth::id(),
            'leave_type' => $request->get('leave_type'),
            'date' => $request->get('date'),
            'message' => $request->get('message')
        ]);

        return sendResponse(200, 'success', $leave);
    }

    public function getMyLeave(Request $request)
    {
        $query = Leave::with([
            'leaveType' => function ($query) {
                $query->select('id', 'name');
            }
        ])->where('user_id', Auth::id());

        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        $data = $query->get();

        return sendResponse(200,'success',$data);
    }
}
