<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function getLeaveTypes()
    {
        $data = LeaveType::select('id', 'name')->get();
        return sendResponse(200, 'success', $data);
    }
}
