<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\TimeZoneTrait;
class AttendanceController extends Controller
{
    use TimeZoneTrait;
    public function checkIn(Request $request)
    {
        $user = Auth::user();

        $countryName = $user->bussinessUnit->country->name;

        $timezone = $this->getTimeZoneFromCountry($countryName);
        $now = Carbon::now($timezone);

        $alreadyCheckedIn = Attendance::where('user_id', $user->id)
            ->whereDate('check_in', $now->toDateString())
            ->exists();


        if ($alreadyCheckedIn) {
            return redirect()->back()->with('error', 'You have already checked in today.');
        }

        $attendance = Attendance::create([
            'user_id' => Auth::id(),
            'check_in' => $now,
            'ip_address' => $request->ip(),
            // 'lat' => $request->lat,
            // 'long' => $request->long,
            'type' => $request->place
        ]);

        return redirect()->back()->with('success', 'Checked in successfully.');
    }

    public function checkOut(Request $request)
    {
        $user = Auth::user();
        $countryName = $user->bussinessUnit->country->name;
        $timezone = $this->getTimeZoneFromCountry($countryName);
        $now = Carbon::now($timezone);

        // Only match today's attendance (check_in is today, and not checked out)
        $attendance = Attendance::where('user_id', $user->id)
            ->whereDate('check_in', $now->toDateString())
            ->whereNull('check_out')
            ->first();

        if ($attendance) {
            $attendance->update([
                'check_out' => $now,
            ]);

            return redirect()->back()->with('success', 'Checked out successfully.');
        } else {
            return redirect()->back()->with('error', 'You already checkout for today.');

        }


    }


}