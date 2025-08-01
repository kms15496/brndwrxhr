@extends('layouts.table-layout')

{{-- @section('title', 'Attendance Dashboard') --}}

@section('content')
    <style>
        .dashboard-wrapper {
            width: 100%;
            padding: 20px;
        }

        .dashboard-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            text-align: left;
            padding-left: 10px;
            color: #1f2937;
        }

        .dashboard-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .dashboard-table thead {
            background-color: #f3f4f6;
        }

        .dashboard-table th,
        .dashboard-table td {
            padding: 12px 10px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
            color: #374151;
        }

        .dashboard-table th {
            font-weight: 600;
            color: #111827;
        }

        .date-row {
            background-color: #f9fafb;
            font-weight: 600;
            color: #2563eb;
        }

        .pagination-wrapper {
            margin-top: 20px;
            text-align: center;
        }

        .pagination .page-link {
            padding: 6px 12px;
            margin: 0 4px;
            font-size: 14px;
            border-radius: 6px;
            background: #fff;
            color: #374151;
            border: 1px solid #d1d5db;
            text-decoration: none;
        }

        .pagination .active .page-link {
            background-color: #2563eb;
            color: white;
            border-color: #2563eb;
        }
    </style>

    <div class="dashboard-wrapper">
        <div class="dashboard-title">Your Attendance</div>

        @if ($data->isEmpty())
            <p class="text-gray-500 text-center">No attendance records found.</p>
        @else
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th style="width: 25%">Date</th>
                        <th style="width: 25%">Check In</th>
                        <th style="width: 25%">Check Out</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $day)
                        @foreach ($day['attendances'] as $index => $attendance)
                            <tr class="{{ $index === 0 ? 'date-row' : '' }}">
                                <td>{{ $index === 0 ? \Carbon\Carbon::parse($day['date'])->format('F j, Y (D)') : '' }}</td>
                                <td>{{ $attendance['check_in'] }}</td>
                                <td>{{ $attendance['check_out'] ?? '-' }}</td>

                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>

            <div class="pagination-wrapper">
                {{ $data->links() }}
            </div>
        @endif
    </div>
@endsection
