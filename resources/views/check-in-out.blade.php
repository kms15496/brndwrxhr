@extends('layouts.table-layout')

@section('title')
    Check In / Out
@endsection

@section('content')
    <style>
        body {
            background: #f1f5f9;
        }

        .card {
            max-width: 500px;
            margin: 80px auto;
            background: #ffffff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .date {
            font-size: 20px;
            color: #555;
            margin-bottom: 8px;
        }

        .clock {
            font-size: 36px;
            font-weight: bold;
            color: #4f46e5;
            margin-bottom: 30px;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .button {
            padding: 12px 24px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
            color: #fff;
        }

        .check-in {
            background-color: #4f46e5;
        }

        .check-in:hover {
            background-color: #4338ca;
        }

        .check-out {
            background-color: #dc2626;
        }

        .check-out:hover {
            background-color: #b91c1c;
        }
    </style>

    @if (session('error'))
        <div class="mb-4 flex items-center justify-between rounded-lg border border-red-300 bg-red-100 px-4 py-3 text-red-800">
            <span class="text-lg font-bold">{{ session('error') }}</span>
        </div>
    @endif

    @if (session('success'))
        <div
            class="mb-4 flex items-center justify-between rounded-lg border border-green-300 bg-green-100 px-4 py-3 text-green-800">
            <span class="text-sm font-medium">{{ session('success') }}</span>

        </div>
    @endif

    <div class="card">
        <!-- Local Date -->
        <div class="date" id="local-date">Loading date...</div>

        <!-- Live Clock -->
        <div class="clock" id="clock">--:--:--</div>

        <!-- Buttons -->
        <div class="button-group">
            <form action="{{ route('check-in') }}" method="POST">
                @csrf
                <input type="hidden" name="lat" id="lat">
                <input type="hidden" name="long" id="long">
                <button type="submit" class="button check-in">Check In</button>
            </form>

            <form action="{{ route('check-out') }}" method="POST">
                @csrf
                <button type="submit" class="button check-out">Check Out</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            });
            document.getElementById('clock').textContent = timeString;
        }

        function updateDate() {
            const now = new Date();
            const dateString = now.toLocaleDateString(undefined, {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
            document.getElementById('local-date').textContent = dateString;
        }

        updateClock();
        updateDate();
        setInterval(updateClock, 1000);
    </script>
@endsection