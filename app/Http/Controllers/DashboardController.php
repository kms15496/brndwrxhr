<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\User;
use App\Models\BussinessUnit;
use Illuminate\Pagination\LengthAwarePaginator;
class DashboardController extends Controller
{
    public function dashboardView()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $role = $user->getRoleNames()->first();


        if ($role === 'admin') {

            $users = User::with('bussinessUnit')->get();

            $businessUnits = BussinessUnit::with([
                'employee' => function ($query) {
                    $query->take(3);
                }
            ])->get();

            return view('dashboard.admin', ['businessUnits' => $businessUnits]);
        }

        $attendances = Attendance::where('user_id', $user_id)->get();



        $groupedData = collect($attendances)
            ->groupBy(function ($item) {
                return \Carbon\Carbon::parse($item['check_in'])->toDateString(); // Group by date
            })
            ->map(function ($items, $date) {
                return [
                    'date' => $date,
                    'attendances' => $items->map(function ($item) {
                        return [
                            'user_id' => $item['user_id'],
                            'check_in' => \Carbon\Carbon::parse($item['check_in'])->format('h:i A'),
                            'check_out' => $item['check_out']
                                ? \Carbon\Carbon::parse($item['check_out'])->format('h:i A')
                                : null,
                        ];
                    })->values()
                ];
            })
            ->sortByDesc('date')
            ->values();

        // Manually paginate grouped data
        $perPage = 5;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $groupedData->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $paginated = new LengthAwarePaginator($currentItems, $groupedData->count(), $perPage, $currentPage, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);

        return view('dashboard.employee', ['data' => $paginated]);
    }
}
