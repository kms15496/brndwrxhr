<?php

namespace App;

trait TimeZoneTrait
{
    public function getTimeZoneFromCountry($countryName)
    {
        // Define your own mapping here
        $timezones = [
            'Myanmar' => 'Asia/Yangon',
            'Thailand' => 'Asia/Bangkok',
            'India' => 'Asia/Kolkata',
            'USA' => 'America/New_York',
            // Add more as needed
        ];

        return $timezones[$countryName] ?? config('app.timezone'); // fallback to default
    }
}
