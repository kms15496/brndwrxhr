@extends('layouts.table-layout')

@section('title')
    Check In / Out
@endsection

@section('content')
    <style>
        body {
            background-color: #f1f5f9;
        }

        .card {
            max-width: 500px;
            margin: 80px auto;
            background-color: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .date {
            font-size: 18px;
            color: #555;
            text-align: center;
            margin-bottom: 10px;
        }

        .clock {
            font-size: 36px;
            font-weight: 600;
            color: #4f46e5;
            text-align: center;
            margin-bottom: 25px;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 5px;
            display: block;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            gap: 15px;
        }

        .button {
            flex: 1;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
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

        .error-text {
            color: red;
            font-weight: bold;
            margin-bottom: 15px;
            display: none;
        }
    </style>

    <div class="card">
        <!-- Date & Time -->
        <div class="date" id="local-date">Loading date...</div>
        <div class="clock" id="clock">--:--:--</div>

        <!-- Check In Form -->
        <form action="{{ route('check-in') }}" method="POST" id="checkInForm">
            @csrf

            <label for="place" class="form-label">Choose Place</label>
            <select name="place" id="place" class="form-control">
                <option value="0">Choose Place</option>
                <option value="work_from_home">Work From Home</option>
                <option value="office">Office</option>
            </select>

            <div id="place-error" class="error-text">
                Please select a valid place.
            </div>

            <input type="hidden" name="lat" id="lat">
            <input type="hidden" name="long" id="long">

            <div class="button-group">
                <button type="submit" class="button check-in">Check In</button>
            </div>
        </form>

        <!-- Check Out Form -->
        <form action="{{ route('check-out') }}" method="POST" class="mt-3">
            @csrf
            <div class="button-group">
                <button type="submit" class="button check-out">Check Out</button>
            </div>
        </form>
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

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    document.getElementById('lat').value = position.coords.latitude;
                    document.getElementById('long').value = position.coords.longitude;
                });
            }
        }

        document.getElementById('checkInForm').addEventListener('submit', function (e) {
            const place = document.getElementById('place').value;
            const errorDiv = document.getElementById('place-error');

            if (place === '0') {
                e.preventDefault();
                errorDiv.style.display = 'block';
            } else {
                errorDiv.style.display = 'none';
            }
        });

        updateClock();
        updateDate();
        getLocation();
        setInterval(updateClock, 1000);
    </script>
@endsection