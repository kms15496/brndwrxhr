<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\TimeZoneTrait;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    use TimeZoneTrait;
    public function checkIn(Request $request)
    {
        // $request->validate([
        //     'lat' => 'required',
        //     'long' => 'required',
        // ]);

        $user = Auth::user();

        $countryName = $user->bussinessUnit->country->name;

        $timezone = $this->getTimeZoneFromCountry($countryName);
        $now = Carbon::now($timezone);

        $alreadyCheckedIn = Attendance::where('user_id', $user->id)
            ->whereDate('check_in', $now->toDateString())
            ->exists();

        $attendance = Attendance::create([
            'user_id' => Auth::id(),
            'check_in' => $now,
            'ip_address' => $request->ip(),
            'type' => $request->type
            // 'lat' => $request->lat,
            // 'long' => $request->long,
        ]);

        $attendance->makeHidden(['created_at', 'updated_at']);
        $attendance->check_in = Carbon::parse($attendance->check_in)->setTimezone($timezone)->format('Y-m-d H:i:s');
        return sendResponse(200, 'success', $attendance);

    }

    public function checkOut(Request $request)
    {

        $user = Auth::user();
        $countryName = $user->bussinessUnit->country->name;
        $timezone = $this->getTimeZoneFromCountry($countryName);
        $now = Carbon::now($timezone);

        $attendance = Attendance::where('user_id', Auth::id())->whereNull('check_out')->first();


        if ($attendance) {
            $attendance->update([
                'check_out' => $now,
            ]);

            $attendance->makeHidden(['created_at', 'updated_at', 'lat', 'long']);
            $attendance->check_out = Carbon::parse($attendance->check_out)->setTimezone($timezone)->format('Y-m-d H:i:s');
            return sendResponse(200, 'success', $attendance);
        }

        return sendResponse(400, 'fail', null);
    }
}